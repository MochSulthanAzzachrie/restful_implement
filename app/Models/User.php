<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use QueryParam\Params\Limiter;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Pagination\LengthAwarePaginator;
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
        'id' => 'string',
    ];

    public static function getUsers(array $fields, ?array $filters, $sorters, Limiter $limiter) : LengthAwarePaginator
    {
        $users = self::query()->select($fields['users']);
        foreach ($fields as $entity => $entityFields) {
            if ($entity != 'users') {
                $users->with([
                    $entity => function ($query) use ($entityFields) {
                        $query->select($entityFields);
                    }
                ]);
            }
        }

        if (is_array($filters)) {
            foreach ($filters as $filter) {
                if ($filter->condition == 'between')
                $users->whereBetween($filter->field, $filter->values);
                else if ($filter->condition == 'like')
                $users->where($filter->field, 'LIKE', '%' . $filter->values[0] . '%');
                else
                $users->where($filter->field, $filter->condition, $filter->values[0]);
            }
        }

        if ($sorters) {
            foreach ($sorters as $sorter) {
                $users->orderBy($sorter->field, $sorter->directive);
            }
        }

        // $users->where('email', 'like', '%' . $search . '%')
        // ->orWhere('username', 'like', '%' . $search . '%')
        // ->orWhere('firstname', 'like', '%' . $search . '%')
        // ->orWhere('lastname', 'like', '%' . $search . '%');

        return $users->paginate($limiter->limit);
    }

    public static function getUserById(array $fields, array $filters)
    {
        $user = self::query()->select($fields['users']);
        foreach ($fields as $entity => $entityFields) {
            if ($entity != 'users') {
                $user->with([
                    $entity => function ($query) use ($entityFields) {
                        $query->select($entityFields);
                    }
                ]);
            }
        }

        if (is_array($filters)) {
            foreach ($filters as $filter) {
                if ($filter->condition == 'between')
                    $user->whereBetween($filter->field, $filter->values);
                else if ($filter->condition == 'like')
                    $user->where($filter->field, 'LIKE', '%' . $filter->values[0] . '%');
                else
                    $user->where($filter->field, $filter->condition, $filter->values[0]);
            }
        }

        return $user->first();
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
        $user = self::find($id);
        $user->delete();

        return $user;
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
