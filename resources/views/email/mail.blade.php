<h1>Dear {{ $userInfo->name }}</h1>
<div class="">You have been registered with role: 
    {{ $userInfo->permissions[0] !=null ? $userInfo->permissions[0]->name: "Normal" }}</div>