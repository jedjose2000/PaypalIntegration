<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountModel extends Model implements Authenticatable
{
    use HasFactory;

    protected $table = 'tblaccounts';
    protected $primaryKey = 'account_id';
    protected $fillable = ['email', 'username', 'password'];

    // Implement the getAuthIdentifierName method
    public function getAuthIdentifierName()
    {
        return 'account_id'; // Replace 'account_id' with your primary key column name
    }

    // Implement the getAuthIdentifier method
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    // Implement the getAuthPassword method
    public function getAuthPassword()
    {
        return $this->password; // Replace 'password' with your actual password column name
    }

    // Implement the following three methods for "Remember Me" functionality:

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }
}


