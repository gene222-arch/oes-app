<?php 
    session_start();
    require_once('./../../../vendor/shuchkin\simplexlsx\src\SimpleXLSX.php');
    require_once('./../../../conn.php');
    use Shuchkin\SimpleXLSX;

    if (isset($_FILES['excel']['name']) && isset($_POST['exam_id'])) 
    {
        $examId = $_POST['exam_id'];
        $excel = $_FILES['excel']['tmp_name'];
        $excel = SimpleXLSX::parse($excel);

        if ($excel)
        {
            $excelData = $excel->rows();
        
            unset($excelData[0]);
    
            $data = [];
    
            $questions = $conn->query('SELECT exam_question FROM exam_question_tbl WHERE exam_id = ' . $examId, PDO::FETCH_OBJ);
            $questions = $questions->fetchAll();
    
            foreach ($questions as $question) {
                $questions[] = $question->exam_question;
            }
    
            foreach ($excelData as $key => $value) 
            {
                $question = $value[0];
                $a = $value[1];
                $b = $value[2];
                $c = $value[3];
                $d = $value[4];
                $correctAnswer = $value[5];
    
                if (! in_array($question, $questions)) 
                {
                    $query = 
                        "INSERT INTO 
                            exam_question_tbl(exam_id, exam_question, exam_ch1, exam_ch2, exam_ch3, exam_ch4, exam_answer) 
                        VALUES
                            ('$examId', '$question', '$a', '$b', '$c', '$d', '$correctAnswer')";
    
                    $conn->query($query);
                }
            }
    
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            $res = array("res" => "success", "msg" => 'Questions imported successfully.');
        }
        else 
        {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }