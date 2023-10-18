<?php

namespace App\Traits;

trait ComparisonNigativeNormalWordsTrait
{
    protected function comparisonNigativeNormalWords($nigativeWords, $normalWords)
    {
        $exclusivelyNigativWords = [];

        foreach ($nigativeWords as $nigativeWord) {
            if (!in_array($nigativeWord, $normalWords)){
                $exclusivelyNigativWords[] = $nigativeWord;
            }
        }

        return $exclusivelyNigativWords;
    }
}