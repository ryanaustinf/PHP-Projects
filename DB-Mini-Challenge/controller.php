<?php
	class Note {
		private $idtodo;
		private $note;
	
		public function __construct( $builder ) {
			$this->idtodo = $builder->getToDoId();
			$this->note = $builder->getNote();
		}
		
		public function getIdToDo() {
			return $this->idtodo;
		}
		
		public function getNote() {
			return $this->note;
		}
		
		public function expose() {
			return get_object_vars($this);
		}
	}
	
	class NoteBuilder {
		private $todoid;
		private $note;
			
		public function __construct() {
			$this->todoid = -1;
			$this->note = "No Notes";
		}
		
		public function getToDoId() {
			return $this->todoid;
		}
		
		public function getNote() {
			return $this->note;
		}
			
		public function note($note) {
			$this->note = $note;
			return $this;
		}
			
		public function todoid($todoid) {
			$this->todoid = $todoid;
			return $this;
		}
			
		public function build() {
			return new Note($this);
		}
	}
	
	require_once("../todo.php");
	
	function getFirstTodo() {
		global $conn;
		$query = "SELECT * FROM todo WHERE status='PENDING' LIMIT 1";
		$result = $conn->query($query);
		if( $result->num_rows > 0 ) {
			$row = $result->fetch_assoc();
			$note = new NoteBuilder();
			return $note->todoid($row['toDoId'])->note($row['content'])->build();
		} else {
			$note = new NoteBuilder();
			return $note->build();
		}
	}
	
	function getLastTodo() {
		global $conn;
		$query = "SELECT * FROM todo WHERE status='PENDING' ORDER BY todoid ".
					"DESC LIMIT 1";
		$result = $conn->query($query);
		if( $result->num_rows > 0 ) {
			$row = $result->fetch_assoc();
			$note = new NoteBuilder();
			return $note->todoid($row['toDoId'])->note($row['content'])
						->build();
		} else {
			$note = new NoteBuilder();
			return $note->build();			
		}
	}
	
	function add($note) {
		global $conn;
		$status = 'PENDING';
		$query = "INSERT INTO todo (content,status) VALUES (?,?)";
		$stmt = $conn->prepare($query);
		$stmt->bind_param("ss",$note,$status);
		$stmt->execute();
	}
	
	function doneToDo($id) {
		global $conn;
		$query = "UPDATE todo SET STATUS='COMPLETE' WHERE todoid=?";
		$stmt = $conn->prepare($query);
		$stmt->bind_param("i",$id);
		$stmt->execute();
	}
	
	function getNextPendingToDo($id) {
		global $conn;
		$query = "SELECT todoid,content FROM todo WHERE status='PENDING' and "
					."todoid>? LIMIT 1;";
		$stmt = $conn->prepare($query);
		$stmt->bind_param("i",$id);
		$stmt->bind_result($todoid,$content);
		$stmt->execute();
		if( $row = $stmt->fetch() ) {
			$note = new NoteBuilder();
			return $note->todoid($todoid)->note($content)->build();
		} else {
			$query = "SELECT todoid,content FROM todo WHERE status='PENDING'"
						." and todoid<? LIMIT 1";
			$stmt = $conn->prepare($query);
			$stmt->bind_param("i",$id);
			$stmt->bind_result($todoid,$content);
			$stmt->execute();
			if( $row = $stmt->fetch() ) {
				$note = new NoteBuilder();
				return $note->todoid($todoid)->note($content)->build();
			} else {
				$note = new NoteBuilder();
				return $note->build();
			}
		}
	}
	
	function getToDo($id) {
		global $conn;
		
		$query = "SELECT todoid, content FROM todo WHERE status='PENDING' and"
					." todoid = ?";
		$stmt = $conn->prepare($query);
		$stmt->bind_param("i",$id);
		$stmt->bind_result($todoid,$content);
		$stmt->execute();
		$note = new NoteBuilder();
		if( $row = $stmt->fetch() ) {
			return $note->todoid($todoid)->note($note)->build();
		} else {
			return $note.build();
		}
	}
	
	function getNextToDo($id) {
		global $conn;
		
		$query = "SELECT todoid, content FROM todo WHERE status='PENDING' and "
					."todoid>? LIMIT 1";
		$stmt = $conn->prepare($query);
		$stmt->bind_param("i",$id);
		$stmt->bind_result($todoid,$content);
		$stmt->execute();
		$note = new NoteBuilder();
		if( $row = $stmt->fetch() ) {
			return $note->todoid($todoid)->note($content)->build();
		} else {
			$query = "SELECT todoid, content FROM todo WHERE status='PENDING'"
						." and todoid<? ORDER BY todoid LIMIT 1;";
			$stmt = $conn->prepare($query);
			$stmt->bind_param("i",$id);
			$stmt->bind_result($todoid,$content);
			$stmt->execute();
			if( $row = $stmt->fetch() ) {
				return $note->todoid($todoid)->note($content)->build();
			} else {
				return getToDo($id);
			}
		}
	}
	
	function getPrevToDo($id) {
		global $conn;
		
		$query = "SELECT todoid, content FROM todo WHERE status='PENDING' "
					."and todoid<? ORDER BY todoid DESC LIMIT 1;";
		$stmt = $conn->prepare($query);
		$stmt->bind_param("i",$id);
		$stmt->bind_result($todoid,$content);
		$stmt->execute();
		$note = new NoteBuilder();
		if( $row = $stmt->fetch() ) {
			return $note->todoid($todoid)->note($content)->build();
		} else {
			$query = "SELECT todoid, content FROM todo WHERE status='PENDING'"
						." and todoid>? ORDER BY todoid DESC LIMIT 1;";
			$stmt = $conn->prepare($query);
			$stmt->bind_param("i",$id);
			$stmt->bind_result($todoid,$content);
			$stmt->execute();
			if( $row = $stmt->fetch() ) {
				return $note->todoid($todoid)->note($content)->build();
			} else {
				return getToDo($id);
			}
		}
	}
	
	$fromIndex = isset($_SESSION['init']) && $_SESSION['init'];
	
	switch( $fromIndex ? "first" : $_GET['request'] ) {
		case "first":
			$note = getFirstTodo();
			if( !$fromIndex ) {
				echo json_encode($note->expose());
			}
			break;
		case "add":
			add($_GET['note']);
			$note = getLastToDo();
			echo json_encode($note->expose());
			break;
		case "done":
			doneToDo($_GET['id']);
			$note = getNextPendingToDo($_GET['id']);
			echo json_encode($note->expose());
			break;
		case "prev":
			$note = getPrevToDo($_GET['id']);
			echo json_encode($note->expose());
			break;
		case "next":
			$note = getNextToDo($_GET['id']);
			echo json_encode($note->expose());
			break;
		default:
	}
	$_SESSION['init'] = false;
?>