<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Posts - SantriKoding.com</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.2/css/dataTables.dataTables.min.css">
</head>
<body style="background: lightgray">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="{{ route('posts.create') }}" class="btn btn-md btn-success mb-3">TAMBAH POST</a>
                        <table id="postsTable" class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">GAMBAR</th>
                                <th scope="col">JUDUL</th>
                                <th scope="col">CONTENT</th>
                                <th scope="col">AKSI</th>
                              </tr>
                            </thead>
                            <tbody>
                              @forelse ($posts as $post)
                                <tr>
                                    <td class="text-center">
                                        <img src="{{ Storage::url('public/posts/').$post->image }}" class="rounded" style="width: 150px">
                                    </td>
                                    <td>{{ $post->title }}</td>
                                    <td>{!! $post->content !!}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                              @empty
                                  <div class="alert alert-danger">
                                      Data Post belum Tersedia.
                                  </div>
                              @endforelse
                            </tbody>
                          </table>
                          {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="//cdn.datatables.net/2.1.2/js/dataTables.min.js"></script>


    <script>

           $(document).ready(function() {
            $('#postsTable').DataTable({
                "ordering": true, // Enable column-based sorting
                "paging": true, // Enable pagination
                "searching": true, // Enable search functionality
                "lengthChange": true, // Enable users to change the number of rows shown
                "pageLength": 10 // Default number of rows shown per page
            });
        });


        //message with toastr
        @if(session()->has('success'))

            toastr.success('{{ session('success') }}', 'BERHASIL!');

        @elseif(session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!');

        @endif
    </script>

</body>
</html>
