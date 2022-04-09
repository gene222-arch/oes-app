<?php 
class SuggestCourseHelper 
{
    public static function preferredStrand(int $examineeId, string $strand): array
    {
        $conn = new PDO("mysql:host=localhost;dbname=oes;",'root', '');

        $stem = $conn
            ->query(
                "SELECT 
                        SUM(examinee_results.average) / COUNT(*) as core_average
                    FROM 
                        examinee_results
                    INNER JOIN 
                        exam_tbl
                    ON 
                        exam_tbl.ex_id = examinee_results.exam_id
                    WHERE 
                        exam_tbl.ex_title IN('English', 'Science', 'Math')
                    AND 
                        examinee_results.examinee_id = $examineeId"
            )
            ->fetch(PDO::FETCH_OBJ);


        $humms = $conn
            ->query(
                "SELECT 
                        SUM(examinee_results.average) / COUNT(*) as core_average
                    FROM 
                        examinee_results
                    INNER JOIN 
                        exam_tbl
                    ON 
                        exam_tbl.ex_id = examinee_results.exam_id
                    WHERE 
                        exam_tbl.ex_title IN('Filipino', 'English', 'Logic')
                    AND 
                        examinee_results.examinee_id = $examineeId"
            )
            ->fetch(PDO::FETCH_OBJ);

        $gas = $conn
            ->query(
                "SELECT 
                        SUM(examinee_results.average) / COUNT(*) as core_average
                    FROM 
                        examinee_results
                    INNER JOIN 
                        exam_tbl
                    ON 
                        exam_tbl.ex_id = examinee_results.exam_id
                    WHERE
                        exam_tbl.ex_title IN('English', 'Filipino', 'Social Science')
                    AND 
                        examinee_results.examinee_id = $examineeId"
            )
            ->fetch(PDO::FETCH_OBJ);

        $techVoc = $conn
            ->query(
                "SELECT 
                        SUM(examinee_results.average) / COUNT(*) as core_average
                    FROM 
                        examinee_results
                    INNER JOIN 
                        exam_tbl
                    ON 
                        exam_tbl.ex_id = examinee_results.exam_id
                    WHERE
                        exam_tbl.ex_title IN('Logic', 'English', 'Ict')
                    AND 
                        examinee_results.examinee_id = $examineeId"
            )
            ->fetch(PDO::FETCH_OBJ);

        $abm = $conn
            ->query(
                "SELECT 
                        SUM(examinee_results.average) / COUNT(*) as core_average
                    FROM 
                        examinee_results
                    INNER JOIN 
                        exam_tbl
                    ON 
                        exam_tbl.ex_id = examinee_results.exam_id
                    WHERE
                        exam_tbl.ex_title IN('Social Science', 'English', 'Logic')
                    AND 
                        examinee_results.examinee_id = $examineeId"
            )
            ->fetch(PDO::FETCH_OBJ);

        $grades = [
            'stem' => (double) $stem->core_average,
            'humms' => (double) $humms->core_average,
            'gas' => (double) $gas->core_average,
            'techVoc' => (double) $techVoc->core_average,
            'abm' => (double) $abm->core_average,
        ];

        ksort($grades);

        $preferredTrack = match(strtolower($strand)) {
            'stem' => [
                'strand' => 'STEM',
                'grade' => (double) $stem->core_average
            ],
            'humms' => [
                'strand' => 'HUMMS',
                'grade' => (double) $humms->core_average
            ],
            'gas' => [
                'strand' => 'GAS',
                'grade' => (double) $gas->core_average
            ],
            'techVoc' => [
                'strand' => 'TECH-VOC',
                'grade' => (double) $techVoc->core_average
            ],
            'abm' => [
                'strand' => 'ABM',
                'grade' => (double) $abm->core_average
            ],
        };

        return [
            'preferred' => $strand,
            'preferredTrack' => $preferredTrack,
            'grades' => $grades
        ];
    }

}