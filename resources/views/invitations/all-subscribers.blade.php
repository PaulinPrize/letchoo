<x-app-layout>
    <x-slot name="header"></x-slot>
    <div class="row">
        <div class="col-lg-12">
            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{$invitation->menu}}</h3>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped projects">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Photo</th>
                                    <th>Téléphone</th>
                                    <th>Email</th>
                                    <th class="text-center">Accept guest</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allSubscribers as $subscriber)
                                    <tr>
                                        <td>
                                            {{ $subscriber->name }} {{ $subscriber->first_name }}<br/>
                                            <small>
                                                <b>Subscription date</b> : {{$subscriber->created_at}}
                                            </small><br/>
                                        </td>
                                        <td>
                                            <img class="table-avatar img-circle elevation-1" width="32" height="32" src="{{ asset('public/storage/'. $subscriber->profile_photo_path) }}"
                                            >
                                        </td>
                                        <td>{{ $subscriber->telephone }}</td>
                                        <td>{{ $subscriber->email }}</td>
                                        <td class="text-center">
                                            <input 
                                                data-id="{{ $subscriber->id }}"
                                                type="checkbox" 
                                                name="toggle2"                                              
                                                {{ $subscriber->activeUser ? 'checked' : '' }}  
                                            >
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $('[name="toggle2"]').each(function() {
                $(this).change(function(){
                    var activeUser = $(this).prop('checked') == true ? 1 : 0; 
                    var id = $(this).attr('data-id'); 
                    $.ajax({
                        type: "GET",
                        dataType: "json",
                        url: "{{route('invitation.accept')}}",
                        data: {'activeUser': activeUser, 'id': id},
                        success: function(data){
                            
                        }
                    });
                })
            });   
        })
    </script>
</x-app-layout> 

