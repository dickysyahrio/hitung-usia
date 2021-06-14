<?php

class Pengguna
{
    public $nama;
    public $mail;
    public $dob;

    public function __construct($data)
    {
        $this->nama = $data['nama'];
        $this->mail = $data['email'];
        $this->dob = $data['dob'];
    }
}

class UserReq
{
    protected static $rules = [
        'nama' => 'string',
        'email' => 'string',
        'dob' => 'string'
    ];

    public static function validate($data){
        foreach (static::$rules as $property => $type){
            if (gettype($data[$property]) != $type){
                throw new \Exception("User property {$property} must be of type {$type}" );
            }
        }
    }
}

class Json{
    public static function from ($data){
        return json_encode($data);
    }
}

class Usia{
    public static function now($data){
        $dob = new DateTime($data['dob']);
        $today = new Datetime(date('d.m.y'));
        return [
            'tahun' => $today->diff($dob)->y,
            'bulan' => $today->diff($dob)->m,
            'hari' => $today->diff($dob)->d,
        ];
    }
}

$data = [
    'nama' => 'Dicky Syahrio', 
    'email' => 'dickysyahrio11@gmail.com',
    'dob' => '13.10.2000'
];

UserReq::validate($data);
$user = new Pengguna($data);
print_r(Json::from($user));
echo '<br>';
print_r(Usia::now($data));
?>