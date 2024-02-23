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
        $users = User::all();

        return $users;
    }

    public static function getUserById($id)
    {
        $user = User::find($id);

        return $user;
    }

    public static function createUser(Request $request) {
        $validated = $request->validate([
            'email' => 'required',
            'username' => 'required|max:225',
            'password' => 'required',
            'firstname' => 'nullable',
            'lastname' => 'nullable',
        ]);

        $user = User::create($request->all());

        return $user;
    }

    public static function editUser(Request $request, $id)
    {
        $validated = $request->validate([
            'email' => 'nullable',
            'username' => 'nullable|max:225',
            'password' => 'nullable',
            'firstname' => 'nullable',
            'lastname' => 'nullable',
        ]);

        $user = User::find($id);
        $user->update($request->all());

        return $user;
    }

    public static function breakUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return $user;
    }

    public static function authRegister() {
        $validator = Validator::make(request()->all(), [
            'email' => 'required|email|unique:users',
            'username' => 'required|max:225',
            'password' => 'required',
            'firstname' => 'nullable',
            'lastname' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        }

        $user = User::create([
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
