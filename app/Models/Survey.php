<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $table = 'surveys';

    protected $fillable = [
        'title',
        'author_id',
        'date_start',
        'date_end',
        'time_limit',
        'note'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }


    public function getDateStartAttribute($tanggal)
    {
        return $this->toIndoDate($tanggal);
    }

    public function getDateEndAttribute($tanggal)
    {
        return $this->toIndoDate($tanggal);
    }

    public function setDateStartAttribute($tanggal)
    {
        $this->attributes['date_start'] = $this->formatDate($tanggal);
    }

    public function setDateEndAttribute($tanggal)
    {
        $this->attributes['date_end'] = $this->formatDate($tanggal);
    }

    private function indoMonth($month_name)
    {
        $month = [
            "Januari" => "01",
            "Februari" => "02",
            "Maret"=> "03",
            "April" => "04",
            "Mei" => "05",
            "Juni" => "06",
            "Juli" => "07",
            "Agustus" => "08",
            "September" => "09",
            "Oktober" => "10",
            "November" =>"11",
            "Desember" => "12"
        ];
        return $month[$month_name];
    }

    private function formatDate($indo_date)
    {
        $date = explode(" ", $indo_date);
        return $date[2].'-'.$this->indoMonth($date[1]).'-'.$date[0];
    }

    private function toIndoMonth($month_number)
    {
        $month = [
            1  => "Januari",
            2  => "Februari",
            3  => "Maret",
            4  => "April",
            5  => "Mei",
            6  => "Juni",
            7  => "Juli",
            8  => "Agustus",
            9  => "September",
            10 => "Oktober",
            11 => "November",
            12 => "Desember"
        ];
        return $month[(int)$month_number];
    }

    private function toIndoDate($date)
    {

        // 2012-24-04 03:09:40

        $mysql_date = explode("-", $date);

        return $mysql_date[2].' '.$this->toIndoMonth($mysql_date[1]).' '.$mysql_date[0];

    }
}
