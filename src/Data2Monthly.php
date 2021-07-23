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

    public function expenseMonthly(Collection $data, string $sortBy, string $sum)
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


    public function expenseYearly(Collection $data, string $sortBy, string $sum)
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

    public function currentWithYear($datas, $sortBy, $year)
    {
        $dataArr = [];
        for ($i=0; $i <= date('m'); $i++) {
            $dataArr[$i] = 0;
        }
        foreach ($datas as $key => $data) {
            if ($data->$sortBy->format('Y') == $year) {
                $month = $data->$sortBy->format('m');
                $month = ltrim($month, '0') - 1;
                $dataArr[$month]++;
            }
            if($key == date('m')) break;
        }
        return $dataArr;
    }
    public function monthlyWithYear($datas, $sortBy, $year)
    {
        $dataArr = [];
        $dataArr = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        foreach ($datas as $key => $data) {
            if ($data->$sortBy->format('Y') == $year) {
                $month = $data->$sortBy->format('m');
                $month = ltrim($month,'0')-1;
                $dataArr[$month]++;
                }
            }
        return $dataArr;
    }

    public function daily(Collection $data, string $sortBy, int $month = null)
    {
        $array_size = 30;
        if (!$month) {
            $month = date('m');
            $array_size = date('d');
        }elseif($month == date('m')){
            $array_size = date('d');
        }
        if ($this->checkCollection($data)) {
            $datas = $data->groupBy(function ($date) use ($sortBy, $month) {
                if (Carbon::parse($date->$sortBy)->format('m') == $month)
                    return Carbon::parse($date->$sortBy)->format('d');
            });

            $datacount = [];
            $dataArr = [];

            foreach ($datas as $key => $value) {
                $datacount[(int)$key] = count($value);
            }

            for ($i = 1, $j = 0; $i <= $array_size; $i++, $j++) {
                if (!empty($datacount[$i])) {
                    $dataArr[$j] = $datacount[$i];
                } else {
                    $dataArr[$j] = 0;
                }
            }
            return $dataArr;
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
