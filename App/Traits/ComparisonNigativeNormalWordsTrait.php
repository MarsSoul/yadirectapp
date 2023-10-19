<?php

namespace App\Traits;

trait ComparisonNigativeNormalWordsTrait
{
    protected function comparisonNigativeNormalWords($nigativeWords, $normalWords)
    {
        $exclusivelyNigativWords = [];
//        var_dump($normalWords);
//        echo '<br><br><br>';
        foreach ($nigativeWords as $nigativeWord) {
//            var_dump($nigativeWord[0]);
//            echo '<br><br><br>';
            $normalWordsList = array_column($normalWords, 0);

            if (!in_array($nigativeWord[0], $normalWordsList)){
                $exclusivelyNigativWords[] = $nigativeWord;
            }
        }

        return $exclusivelyNigativWords;
    }
}