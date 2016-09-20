@extends('admin.public.master')

@section('title','权限管理')

@section('nav','权限管理')

@section('body')

    <!-- 导航栏结束 -->
    <ul id="myTab" class="nav nav-tabs">
        <li class="active">
            <a href="#home" data-toggle="tab">权限列表</a>
        </li>
        <li>
            <a href="javascript:;" onclick="add()">添加权限</a>
        </li>
    </ul>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade in active" id="home">
            <table class="table table-striped table-bordered table-hover table-condensed">
                <tr>
                    <th>权限名</th>
                    <th>权限</th>
                    <th>操作</th>
                </tr>
                @foreach($data as $v)
                    <tr>
                        <td>{{ $v['_name'] }}</td>
                        <td>{{ $v['name'] }}</td>
                        <td>
                            <a href="javascript:;" ruleId="{{ $v['id'] }}" onclick="add_child(this)">添加子权限</a> |
                            <a href="javascript:;" ruleId="{{ $v['id'] }}" ruleName="{{ $v['name'] }}" ruleTitle="{{ $v['title'] }}" onclick="edit(this)">修改</a> |
                            <a href="javascript:if(confirm('确定删除？'))location='{{ url('admin/rule/delete',['id'=>$v['id']]) }}'">删除</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

    <!-- 添加菜单模态框开始 -->
    <div class="modal fade" id="bjy-add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        添加权限
                    </h4>
                </div>
                <div class="modal-body">
                    <form id="bjy-form" class="form-inline" action="{{ url('admin/rule/store') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="pid" value="0">
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <tr>
                                <th width="12%">权限名：</th>
                                <td>
                                    <input class="form-control" type="text" name="title">
                                </td>
                            </tr>
                            <tr>
                                <th>权限：</th>
                                <td>
                                    <input class="form-control" type="text" name="name"> 输入模块/控制器/方法即可 例如 admin/rule/index
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>
                                    <input class="btn btn-success" type="submit" value="添加">
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- 添加菜单模态框结束 -->

    <!-- 修改菜单模态框开始 -->
    <div class="modal fade" id="bjy-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        修改权限
                    </h4>
                </div>
                <div class="modal-body">
                    <form id="bjy-form" class="form-inline" action="{{ url('admin/rule/update') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="id">
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <tr>
                                <th width="12%">权限名：</th>
                                <td>
                                    <input class="form-control" type="text" name="title">
                                </td>
                            </tr>
                            <tr>
                                <th>权限：</th>
                                <td>
                                    <input class="form-control" type="text" name="name"> 输入模块/控制器/方法即可 例如 admin/rule/index
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>
                                    <input class="btn btn-success" type="submit" value="修改">
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- 修改菜单模态框结束 -->

@endsection

@section('js')

    <script>
        // 添加菜单
        function add(){
            $("input[name='title'],input[name='name']").val('');
            $("input[name='pid']").val(0);
            $('#bjy-add').modal('show');
        }

        // 添加子菜单
        function add_child(obj){
            var ruleId=$(obj).attr('ruleId');
            $("input[name='pid']").val(ruleId);
            $("input[name='title']").val('');
            $("input[name='name']").val('');
            $('#bjy-add').modal('show');
        }

        // 修改菜单
        function edit(obj){
            var ruleId=$(obj).attr('ruleId');
            var ruletitle=$(obj).attr('ruletitle');
            var ruleName=$(obj).attr('ruleName');
            $("input[name='id']").val(ruleId);
            $("input[name='title']").val(ruletitle);
            $("input[name='name']").val(ruleName);
            $('#bjy-edit').modal('show');
        }
    </script>

@endsection

