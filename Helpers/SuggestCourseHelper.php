<?php 
class SuggestCourseHelper 
{
    
    public static function preferredStrand(int $examineeId, string $strand): array
    {
        $strand = strtoupper($strand);

        switch ($strand) 
        {
            case 'STEM':
                return self::stemStrand($examineeId);

            case 'HUMMS':
                return self::hummsStrand($examineeId);

            case 'GAS':
                return self::gasStrand($examineeId);
        
            case 'TECH-VOC':
                return self::techVocStrand($examineeId);

            case 'ABM':
                return self::abmStrand($examineeId);
        }
    }

    /**
     * * Done
     */
    public static function stemStrand(int $examineeId): array
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
                        exam_tbl.ex_title IN('English', 'Science', 'Math')
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
                        exam_tbl.ex_title NOT IN('English', 'Science', 'Math')
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

            if ($minorAverage <= 80) 
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

    /**
     * 
     */

    public static function hummsStrand(int $examineeId): array
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
                        exam_tbl.ex_title IN('Filipino', 'English', 'Logic')
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
                        exam_tbl.ex_title NOT IN('Filipino', 'English', 'Logic')
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
                    'HUMMS is recommended',
                    'Average: ' . number_format($coreAverage)
                ];
            }

            if ($minorAverage >= 80) 
            {
                return [
                    'HUMMS is not recommended',
                    'Average: ' . number_format($minorAverage, 2),
                    'otherRecommendations' => [
                        '<strong class="text-info">Sub recommendations</strong>',
                        'ABM',
                        'STEM',
                        'GAS',
                        'TECH-VOC'
                    ]
                    ];
            }

            return [
                'HUMMS is not recommended',
                'Average: ' . '<strong>' . number_format($overallAverage, 2) . '%</strong>',
                'otherRecommendations' => [
                    '<strong class="text-info">Sub recommendations</strong>',
                    'ABM',
                    'STEM',
                    'GAS',
                    'TECH-VOC'
                ]
            ];
    }

    /**
     * * Done
     */
    public static function gasStrand(int $examineeId): array
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
                        exam_tbl.ex_title IN('English', 'Filipino', 'Social Science')
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
                        exam_tbl.ex_title NOT IN('English', 'Filipino', 'Social Science')
                    AND 
                        examinee_results.examinee_id = $examineeId"
            )
            ->fetch(PDO::FETCH_OBJ);

            $coreAverage = (double) $coreResult->core_average;
            $minorAverage = (double) $minorResult->minor_average;
            $overallAverage = ($coreAverage + $minorAverage) / 2;

            if ($coreAverage >= 80 || $minorAverage >= 85 || $overallAverage >= 80) 
            {
                return [
                    'GAS is recommended',
                    'Average: ' . number_format($coreAverage)
                ];
            }

            if ($minorAverage < 85) 
            {
                return [
                    'GAS is not recommended',
                    'Average: ' . number_format($minorAverage, 2),
                    'otherRecommendations' => [
                        '<strong class="text-info">Sub recommendations</strong>',
                        'ABM',
                        'HUMSS',
                        'STEM',
                        'TECH-VOC'
                    ]
                    ];
            }

            return [
                'GAS is not recommended',
                'Average: ' . '<strong>' . number_format($overallAverage, 2) . '%</strong>',
                'otherRecommendations' => [
                    '<strong class="text-info">Sub recommendations</strong>',
                    'ABM',
                    'HUMSS',
                    'STEM',
                    'TECH-VOC'
                ]
            ];
    }

    /**
     * * Done
     */
    public static function techVocStrand(int $examineeId): array
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
                        exam_tbl.ex_title IN('Logic', 'English', 'Ict')
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
                        exam_tbl.ex_title NOT IN('Logic', 'English', 'Ict')
                    AND 
                        examinee_results.examinee_id = $examineeId"
            )
            ->fetch(PDO::FETCH_OBJ);

            $coreAverage = (double) $coreResult->core_average;
            $minorAverage = (double) $minorResult->minor_average;
            $overallAverage = ($coreAverage + $minorAverage) / 2;

            if ($coreAverage >= 80 || $minorAverage >= 85 || $overallAverage >= 80) 
            {
                return [
                    'TECH-VOC is recommended',
                    'Average: ' . number_format($coreAverage)
                ];
            }

            if ($minorAverage < 85) 
            {
                return [
                    'TECH-VOC is not recommended',
                    'Average: ' . number_format($minorAverage, 2),
                    'otherRecommendations' => [
                        '<strong class="text-info">Sub recommendations</strong>',
                        'STEM',
                        'HUMSS',
                        'GAS',
                        'ABM'
                    ]
                    ];
            }

            return [
                'TECH-VOC is not recommended',
                'Average: ' . '<strong>' . number_format($overallAverage, 2) . '%</strong>',
                'otherRecommendations' => [
                    '<strong class="text-info">Sub recommendations</strong>',
                    'STEM',
                    'HUMSS',
                    'GAS',
                    'ABM'
                ]
            ];
    }

    /**
     * * Done
     */
    public static function abmStrand(int $examineeId): array
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
                        exam_tbl.ex_title IN('Social Science', 'English', 'Logic')
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
                        exam_tbl.ex_title NOT IN('Social Science', 'English', 'Logic')
                    AND 
                        examinee_results.examinee_id = $examineeId"
            )
            ->fetch(PDO::FETCH_OBJ);

            $coreAverage = (double) $coreResult->core_average;
            $minorAverage = (double) $minorResult->minor_average;
            $overallAverage = ($coreAverage + $minorAverage) / 2;

            if ($coreAverage >= 80 || $minorAverage >= 85 || $overallAverage >= 80) 
            {
                return [
                    'ABM is recommended',
                    'Average: ' . number_format($coreAverage)
                ];
            }

            if ($minorAverage < 85) 
            {
                return [
                    'ABM is not recommended',
                    'Average: ' . number_format($minorAverage, 2),
                    'otherRecommendations' => [
                        '<strong class="text-info">Sub recommendations</strong>',
                        'STEM',
                        'HUMSS',
                        'GAS',
                        'TECH-VOC'
                    ]
                    ];
            }

            return [
                'ABM is not recommended',
                'Average: ' . '<strong>' . number_format($overallAverage, 2) . '%</strong>',
                'otherRecommendations' => [
                    '<strong class="text-info">Sub recommendations</strong>',
                    'STEM',
                    'HUMSS',
                    'GAS',
                    'TECH-VOC'
                ]
            ];
    }

}