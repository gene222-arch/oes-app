<?php 
class SuggestCourseHelper 
{
    public static function preferredCourse(int $examineeId): array
    {
        $conn = new PDO("mysql:host=localhost;dbname=oes;",'root', '');

            $coreResult = $conn
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
                        exam_tbl.ex_title = 'English'
                    OR 
                        exam_tbl.ex_title = 'Science'
                    OR 
                        exam_tbl.ex_title = 'Math'
                    AND 
                        examinee_results.examinee_id = $examineeId"
            )
            ->fetch(PDO::FETCH_OBJ);

            $minorResult = $conn
            ->query(
                "SELECT 
                        SUM(examinee_results.average) / COUNT(*) as minor_average
                    FROM 
                        examinee_results
                    INNER JOIN 
                        exam_tbl
                    ON 
                        exam_tbl.ex_id = examinee_results.exam_id
                    WHERE 
                        exam_tbl.ex_title != 'English'
                    OR 
                        exam_tbl.ex_title != 'Science'
                    OR 
                        exam_tbl.ex_title != 'Math'
                    AND 
                        examinee_results.examinee_id = $examineeId"
            )
            ->fetch(PDO::FETCH_OBJ);

            $coreAverage = (double) $coreResult->core_average;
            $minorAverage = (double) $minorResult->minor_average;
            $overallAverage = ($coreAverage + $minorAverage) / 2;

            if ($coreAverage >= 85 || $minorAverage >= 90 || $overallAverage >= 85) 
            {
                return [
                    'STEM is recommended',
                    'Average: ' . number_format($coreAverage)
                ];
            }

            if ($minorAverage >= 80) 
            {
                return [
                    'STEM is not recommended',
                    'Average: ' . number_format($minorAverage, 2),
                    'otherRecommendations' => [
                        '<strong class="text-info">Sub recommendations</strong>',
                        'ABM',
                        'HUMSS',
                        'GAS',
                        'TECH-VOC'
                    ]
                    ];
            }

            return [
                'STEM is not recommended',
                'Average: ' . '<strong>' . number_format($overallAverage, 2) . '%</strong>',
                'otherRecommendations' => [
                    '<strong class="text-info">Sub recommendations</strong>',
                    'TECH-VOC'
                ]
            ];
    }
}