@php
 $menu = [
    'System Menu'=>[
        ['name'=>'Create User','link'=>'/system/user_manager','icon'=>'fa fa-plus-square','border'=>false],
    ],
    'Master Data'=>[
        ['name'=>'General Ledger','link'=>'/acura-master/coa','icon'=>'fa fa-plus-square','border'=>true],
        ['name'=>'Salesman','link'=>'/acura-master/salesman','icon'=>'fa fa-group','border'=>false],
        ['name'=>'Target Box Salesman','link'=>'/acura-master/salesmanbox','icon'=>'fa fa-leanpub','border'=>true],
        ['name'=>'Area Penjualan','link'=>'/acura-master/area_jual','icon'=>'fa fa-plus-square','border'=>false],
        ['name'=>'Angkutan','link'=>'/acura-master/angkutan','icon'=>'fa fa-plus-square','border'=>true],
        ['name'=>'Supplier','link'=>'/acura-master/supplier','icon'=>'fa fa-plus-square','border'=>false],
        ['name'=>'Pelanggan','link'=>'/acura-master/customer','icon'=>'fa fa-plus-square','border'=>false],
        ['name'=>'Bank Pelanggan','link'=>'#','icon'=>'fa fa-plus-square','border'=>true],
        ['name'=>'Persediaan','link'=>'#','icon'=>'fa fa-plus-square','border'=>false],
        ['name'=>'Informasi Gudang','link'=>'#','icon'=>'fa fa-plus-square','border'=>false],
    ]
 ]   
@endphp
    <li class="">
        <a href="/">
            Home
        </a>
    </li>
    @foreach ($menu as $key => $menuItem)
    <li class="dropdown" >
        <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown">{{$key}}</a>
        <ul role="menu" class="dropdown-menu">
            @foreach ($menuItem as $item)
                <li class="{{$item['border']?'border-bottom':''}}" style="width: 200px;">
                    <a href="{{$item['link']}}">
                        <i class="{{$item['icon']}}" aria-hidden="true"></i>
                        {{$item['name']}}
                    </a>
                </li>
            @endforeach
        </ul>
    </li>
    @endforeach