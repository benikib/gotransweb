<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use  HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *s
     * @var list<string>
     */
    protected $fillable = [

        'name',
        'email',
        'number_phone',
        'password',
        'google_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function admin(){
        return $this->hasMany(Admin::class);
    }
    public function client(){
        return $this->hasMany(Client::class);
    }


    public function livreur()
    {
        return $this->hasOne(Livreur::class, 'user_id', 'id');
    }
    public function livreur_vehicule()
    {
        return $this->hasManyThrough(Livreur_Vehicule::class, Livreur::class, 'user_id', 'livreur_id', 'id', 'id');

    }
    public function getRoleInfo(): ?array
{
    if ($this->livreur) {
        return [
            'id' => $this->livreur->id,
            'role' => 'livreur',
        ];
    }

    if ($this->client()->exists()) {
        $client = $this->client()->first();
        return [
            'id' => $client->id,
            'role' => 'client',
        ];
    }

    if ($this->admin()->exists()) {
        $admin = $this->admin()->first();
        return [
            'id' => $admin->id,
            'role' => 'admin',
        ];
    }

    return null;
}


}
