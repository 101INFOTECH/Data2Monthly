<?php

namespace Infotech\Data2Monthly;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class Data2Monthly
{
    public function current(Collection $data, string $sortBy)
    {
        if ($this->checkCollection($data)) {
            $datas = $data->groupBy(function ($date) use ($sortBy) {
                return Carbon::parse($date->$sortBy)->format('m');
            });

            $datacount = [];
            $dataArr = [];

            foreach ($datas as $key => $value) {
                $datacount[(int)$key] = count($value);
            }

            for ($i = 1,$j =0 ; $i <= date('m'); $i++,$j++) {
                if (!empty($datacount[$i])) {
                    $dataArr[$j] = $datacount[$i];
                } else {
                    $dataArr[$j] = 0;
                }
            }
            return $dataArr;
        }
    }

    public function yearly(Collection $data, string $sortBy)
    {
        if ($this->checkCollection($data)) {
            $findYear = $data;
            $findYear = $findYear->last();
            $first =  $findYear->$sortBy->format('Y');
            $datas = $data->groupBy(function ($date) use ($sortBy) {
                return Carbon::parse($date->$sortBy)->format('Y');
            });

            $datacount = [];
            $dataArr = [];

            foreach ($datas as $key => $value) {
                $datacount[(int)$key] = count($value);
            }

            for ($i = $first, $j = 0; $i <= date('Y'); $i++, $j++) {
                if (!empty($datacount[$i])) {
                    $dataArr[$j] = $datacount[$i];
                } else {
                    $dataArr[$j] = 0;
                }
            }
            return $dataArr;
        }
    }

    public function monthly(Collection $data, string $sortBy)
    {
        if ($this->checkCollection($data)) {
            $datas = $data->groupBy(function ($date) use ($sortBy) {
                return Carbon::parse($date->$sortBy)->format('m');
            });

            $datacount = [];
            $dataArr = [];

            foreach ($datas as $key => $value) {
                $datacount[(int)$key] = count($value);
            }

            for ($i = 1, $j = 0; $i <= 12; $i++, $j++) {
                if (!empty($datacount[$i])) {
                    $dataArr[$j] = $datacount[$i];
                } else {
                    $dataArr[$j] = 0;
                }
            }
            return $dataArr;
        }
    }

    public function expenseCurrent(Collection $data, string $sortBy, string $sum)
    {
        if ($this->checkCollection($data)) {
            $datas = $data->groupBy(function ($date) use ($sortBy) {
                return Carbon::parse($date->$sortBy)->format('m');
            });

            $datacount = [];
            $dataArr = [];

            foreach ($datas as $key => $value) {
                $datacount[(int)$key] = $value->sum($sum);
            }

            for ($i = 1, $j = 0; $i <= date('m'); $i++, $j++) {
                if (!empty($datacount[$i])) {
                    $dataArr[$j] = $datacount[$i];
                } else {
                    $dataArr[$j] = 0;
                }
            }
            return $dataArr;
        }
    }

    public function expenseMonthly(Collection $data,string $sortBy,string $sum)
    {
        if ($this->checkCollection($data)) {
            $datas = $data->groupBy(function ($date) use ($sortBy) {
                return Carbon::parse($date->$sortBy)->format('m');
            });

            $datacount = [];
            $dataArr = [];

            foreach ($datas as $key => $value) {
                $datacount[(int)$key] = $value->sum($sum);
            }

            for ($i = 1, $j = 0; $i <= 12; $i++, $j++) {
                if (!empty($datacount[$i])) {
                    $dataArr[$j] = $datacount[$i];
                } else {
                    $dataArr[$j] = 0;
                }
            }
            return $dataArr;
        }
    }


    public function expenseYearly(Collection $data,string $sortBy,string $sum)
    {
        if ($this->checkCollection($data)) {

            $findYear = $data;
            $findYear = $findYear->last();
            $first =  $findYear->$sortBy->format('Y');

            $datas = $data->groupBy(function ($date) use ($sortBy) {
                return Carbon::parse($date->$sortBy)->format('m');
            });

            $datacount = [];
            $dataArr = [];

            foreach ($datas as $key => $value) {
                $datacount[(int)$key] = $value->sum($sum);
            }

            for ($i = $first, $j = 0; $i <= date('Y'); $i++, $j++) {
                if (!empty($datacount[$i])) {
                    $dataArr[$j] = $datacount[$i];
                } else {
                    $dataArr[$j] = 0;
                }
            }
            return $dataArr;
        }
    }

    // Test 
    public function test($datas,$sortBy)
    {
        $dataArr = [];
        foreach ($datas as $key => $data) {
         if($data->$sortBy->format('Y') == date('Y')) 
         $dataArr[(int)$key] = true; 
        }
    }

    private function checkCollection($data)
    {
        if ($data instanceof Collection)
            return true;
        else
            throw new \Exception("The first argument passed must be a Collection  (Data2Monthly)");
    }
}
