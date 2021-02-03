<?php
namespace App\Traits;
use App\Models\{Role, Permission};
use Arr;

trait RolePermission
{

    public function hasRole(...$roles){
        foreach($roles as $role){
            if($this->roles->contains('name', $role)) return true;
        }
        return false;
    }

    public function hasPermissionTo($permission){
        return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);
    }

    protected function hasPermission($permission){
        return (bool) $this->permissions->where('name', $permission->name)->count();
    }

    public function hasPermissionThroughRole($permission){
        foreach($permission->roles as $role){
            if($this->roles->contains($role)) return true;
        }
        return false;
    }


    //ex givePermissionTo(['edit','delete']) || givePermissionTo('edit','delete')
    public function givePermissionTo(...$permissions){
        // Arr::flatter() untuk merubah nested array jadi flat array
        $permissions = $this->getPermissions(Arr::flatten($permissions)); 
        if($permissions===null) return $this;
        
        $this->permissions()->saveMany($permissions);
        return $this;
    }

    public function getPermissions(array $permissions){
        return Permission::whereIn('name', $permissions)->get();
    }

    //ex revokePermission(['edit','delete']) || revokePermission('edit','delete')
    public function revokePermission(...$permissions){
        $permissions = $this->getPermissions(Arr::flatten($permissions)); 
        $this->permissions()->detach($permissions);
        return $this;
    }

    public function refreshPermission(...$permissions){
        $this->permissions()->detach();
        return $this->givePermissionTo($permissions); 
    }



    public function roles(){
        return $this->belongsToMany(Role::class, 'users_roles');
    }

    public function permissions(){
        return $this->belongsToMany(Permission::class, 'users_permissions');
    }


}

?>