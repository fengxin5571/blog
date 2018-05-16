<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">

            <li class="treeview active">

                @can('system')
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>系统管理</span>
                    <span class="pull-right-container"></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/admin/permissions"><i class="fa fa-circle-o"></i> 权限管理</a></li>
                    <li><a href="/admin/users"><i class="fa fa-circle-o"></i> 用户管理</a></li>
                    <li><a href="{{route('admin.roles')}}"><i class="fa fa-circle-o"></i> 角色管理</a></li>
                </ul>
            </li>
            @endcan
            @can('post')
            <li class="active treeview">
                <a href="/admin/posts">
                    <i class="fa fa-dashboard"></i> <span>文章管理</span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin.posts.status.1')}}"><i class="fa fa-circle-o"></i> 已通过文章</a></li>
                    <li><a href="{{route('admin.posts.status.2')}}"><i class="fa fa-circle-o"></i> 未通过文章</a></li>
                    <li><a href="{{route('admin.posts.del.list')}}"><i class="fa fa-circle-o"></i> 已删除文章</a></li>
                </ul>
            </li>
            @endcan
            @can('topic')
            <li class="active treeview">
                <a href="{{route('admin.topics.index')}}">
                    <i class="fa fa-dashboard"></i> <span>专题管理</span>
                </a>
            </li>
            @endcan
            @can('notice')
            <li class="active treeview">
                <a href="{{route('admin.notices')}}">
                    <i class="fa fa-dashboard"></i> <span>通知管理</span>
                </a>
            </li>
            @endcan
    </ul>
</section>