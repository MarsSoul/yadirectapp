<?php

namespace App\Traits;

trait ComparisonNigativeNormalWordsTrait
{
    protected function comparisonNigativeNormalWords($nigativeWords, $normalWords)
    {
        $exclusivelyNigativWords = [];

        foreach ($nigativeWords as $nigativeWord) {

            $normalWordsList = array_column($normalWords, 0);

            if (!in_array($nigativeWord[0], $normalWordsList)){
                $exclusivelyNigativWords[] = $nigativeWord;
            }
        }

        return $exclusivelyNigativWords;
    }
}