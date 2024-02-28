<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = [
        'email',
        'username',
        'password',
        'firstname',
        'lastname',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public static function getUsers()
    {
        $users = self::all();

        return $users;
    }

    public static function getUserById($id)
    {
        $user = self::find($id);

        return $user;
    }

    public static function createUser(array $data)
    {

        $user = self::create($data);

        return $user;
    }

    public static function updateUser(array $data, $id)
    {

        $user = self::find($id);
        $user->update($data);

        return $user;
    }

    public static function deleteUser($id)
    {
        $user = self::findOrFail($id);
        $user->delete();

        return $user;
    }

    public static function authRegister() {

        $user = self::create([
            'email' => request('email'),
            'username' => request('username'),
            'password' => Hash::make(request('password')),
            'firstname' => request('firstname'),
            'lastname' => request('lastname'),
        ]);

        return $user;
    }

    public static function authLogin() {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $token;
    }

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
