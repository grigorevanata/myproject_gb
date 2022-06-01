@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Список новостей</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('admin.news.create') }}" class="btn btn-sm btn-outline-secondary">Добавить новость</a>
            </div>
        </div>
    </div>

    <div class="table-responsive">
    @include('inc.messages')
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th scope="col">#ID</th>
                <th scope="col">Категория</th>
                <th scope="col">Наименование</th>
                <th scope="col">Автор</th>
                <th scope="col">Статус</th>
                <th scope="col">Дата добавления</th>
                <th scope="col">Управление</th>
            </tr>
            </thead>
            <tbody>
            @foreach($news as $newsItem)
                  <tr>
                      <td>{{ $newsItem->id }}</td>
                      <td>{{ $newsItem->category->title }}</td>
                      <td>{{ $newsItem->title }}</td>
                      <td>{{ $newsItem->author }}</td>
                      <td>{{ $newsItem->status }}</td>
                      <td>{{ $newsItem->created_at }}</td>
                      <td><a href="{{ route('admin.news.edit', ['news' => $newsItem]) }}" style="font-size: 12px;">Ред.</a> &nbsp;
                          <a href="javascript:;" class="delete" rel="{{ $newsItem->id }}" style="color:red; font-size: 12px;">Уд.</a></td>
                  </tr>
              @endforeach
            </tbody>
        </table>

        {{ $news->links() }}
    </div>
@endsection


@push('js')
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            const el = document.querySelectorAll(".delete");
            el.forEach(function(value, key){
                value.addEventListener('click', function(){
                    const id = this.getAttribute('rel');
                    if(confirm('Подтвердите удаление записи с #ID ${id} ?')){
                        send('/admin/news/' + id).then(() => {
                            location.reload();
                        });

                    }

                });

            });

        });         
                
                  
                
        async function send(url) {
            let response = await fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                        .getAttribute('content')
                }
                
            });

            let result = await response.json();
            return result.ok;

        }        
    
    </script>
@endpush
