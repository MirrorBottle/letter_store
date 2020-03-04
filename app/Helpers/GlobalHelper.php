<?php

function to_indo_day($day)
{
    $list_day = [
        1 => 'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu',
        'Minggu',
    ];

    return $list_day[(int) $day];
}

function to_indo_month($month, $short = false)
{
    $list_month = [
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    ];

    if ($short) {
        return substr($list_month[(int) $month], 0, 3);
    }

    return $list_month[(int) $month];
}

function from_indo_month($month_name)
{
    $list_month = [
        'Januari' => '01',
        'Februari' => '02',
        'Maret' => '03',
        'April' => '04',
        'Mei' => '05',
        'Juni' => '06',
        'Juli' => '07',
        'Agustus' => '08',
        'September' => '09',
        'Oktober' => '10',
        'November' => '11',
        'Desember' => '12'
    ];

    return $list_month[$month_name];
}

function to_mysql_date($date, $separator = ' ', $short = false)
{
    $split_date = explode('-', $date);
    return $split_date[2] . $separator .
        to_indo_month($split_date[1], $short) . $separator .
        $split_date[0];
}

// type null = angka bulan
// type 1 = nama bulan panjang
// type 2 = nama bulan pendek
function to_indo_date($date, $type = null, $separator = ' ')
{
    $split_date = explode('-', $date);

    if ($type == 1) {
        return $split_date[2]
            . $separator . to_indo_month($split_date[1])
            . $separator . $split_date[0];
    } else if ($type == 2) {
        return $split_date[2]
            . $separator . to_indo_month($split_date[1], true)
            . $separator . $split_date[0];
    }

    return $split_date[2] . $separator . $split_date[1] . $separator . $split_date[0];
}

function from_indo_date($date, $type = null, $separator = ' ')
{
    $split_date = explode('-', $date);

    if ($type == 1) {
        return $split_date[2]
            . $separator . to_indo_month($split_date[1])
            . $separator . $split_date[0];
    } else if ($type == 2) {
        return $split_date[2]
            . $separator . to_indo_month($split_date[1], true)
            . $separator . $split_date[0];
    }

    return $split_date[2] . $separator . $split_date[1] . $separator . $split_date[0];
}
