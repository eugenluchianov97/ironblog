<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
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


    const ROLE_USER = 'user';

    const ROLE_ADMIN_SUPER = 'super_admin';

    const ROLES = [
        self::ROLE_USER,
        self::ROLE_ADMIN_SUPER,
    ];

    const ROLES_FOR_CREATE = [
        self::ROLE_USER,
    ];



    public function posts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function is_user(): bool
    {
         return $this->role ===  self::ROLE_USER;
    }

    public function is_super_admin(): bool
    {
        return $this->role ===  self::ROLE_ADMIN_SUPER;
    }

    /** permissions **/

    public function can_update_user($user): bool
    {
        /** если запрос посылает не админ или не суперадмин **/
        if($this->role !== self::ROLE_ADMIN_SUPER){
            return false;
        }
        if($user->role === self::ROLE_ADMIN_SUPER && $this->role !== self::ROLE_ADMIN_SUPER){
           return false;
        }

        return true;
    }

    public function can_create_user($role): bool
    {
        /** если запрос посылает не суперадмин **/
        if($this->role !== self::ROLE_ADMIN_SUPER){
            return false;
        }
        /** нельяз создать суперадмина **/
        if($role === self::ROLE_ADMIN_SUPER){
            return false;
        }

        return true;
    }

    public function can_read_user(): bool
    {
        /** если запрос посылает не админ или не суперадмин **/
        if($this->role !== self::ROLE_ADMIN_SUPER){
            return false;
        }

        return true;
    }

    public function can_delete_user($user): bool
    {
        /** если запрос посылает не суперадмин **/
        if($this->role !== self::ROLE_ADMIN_SUPER){
            return false;
        }
        /** нельзя удалить суперадмина **/
        if($user->role === self::ROLE_ADMIN_SUPER){
            return false;
        }

        return true;
    }

    public function can_edit_tags(): bool
    {
        if($this->role === self::ROLE_ADMIN_SUPER ){
            return true;
        }
            return false;
    }

    public function can_create_tags(): bool
    {
        if($this->role === self::ROLE_ADMIN_SUPER ){
            return true;
        }
        return false;
    }

    public function can_delete_tags(): bool
    {
        if($this->role === self::ROLE_ADMIN_SUPER ){
            return true;
        }
        return false;
    }


    public function can_edit_categories(): bool
    {
        if($this->role === self::ROLE_ADMIN_SUPER ){
            return true;
        }
        return false;
    }

    public function can_create_categories(): bool
    {
        if($this->role === self::ROLE_ADMIN_SUPER ){
            return true;
        }
        return false;
    }

    public function can_delete_categories(): bool
    {
        if($this->role === self::ROLE_ADMIN_SUPER ){
            return true;
        }
        return false;
    }

    public function can_edit_post($post){
        if($this->role === self::ROLE_ADMIN_SUPER ){
            return true;
        }
        if($this->posts->contains('id', $post->id)){
            return true;
        }

        return false;
    }

    public function can_view_post($post){
        if($this->role === self::ROLE_ADMIN_SUPER ){
            return true;
        }
        if($this->posts->contains('id', $post->id)){
            return true;
        }

        return false;
    }

    public function can_delete_post($post){
        if($this->role === self::ROLE_ADMIN_SUPER ){
            return true;
        }
        if($this->posts->contains('id', $post->id)){
            return true;
        }

        return false;
    }

}
