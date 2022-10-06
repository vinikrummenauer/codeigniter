<?php namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model{
    protected $table = 'user';

    public function getByEmail(string $email) : array{
        $rq = $this->where('email', $email)->first();

        return !is_null($rq) ? $rq : [];
    }

    public function select($tabela, $req){
        $sql = "SELECT * FROM " . $tabela . " WHERE email = " . $req;
        $rq = $this->select('email', $email)->first();

        return $rq;
    }
}
