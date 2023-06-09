@extends('adminlte::page')

@section('plugins.Datatables', true)

@section('title')
    Page | Panne
@endsection


@section('content')
<div class="container ">
    <div class="row ">
        
            <div class="col-md-4 mt-4">
                <div class="small-box" style="background-color: rgb(218, 51, 204)">
                 <div class="inner">
                     <h3>{{ \App\Models\Vehicule::count() }}</h3>
                     <p class="text-bold">Vehicule</p>
                 </div>
                 <div class="icon">
                     <i class="fas fa-car"></i>
                 </div>
                 <a href="{{ url('admin/vehicules') }}" class="small-box-footer">
                 more info <i class="fas fa-arrow-circle-right"></i>
                 </a>
                </div>
            </div>

            <div class="col-md-4 mt-4">
                <div class="small-box" style="background-color: rgb(64, 233, 115)">
                 <div class="inner">
                     <h3>{{ \App\Models\Reparation::count() }}</h3>
                     <p class="text-bold">Reaparation</p>
                 </div>
                 <div class="icon">
                     <i class="fas fa-wrench"></i>
                 </div>
                 <a href="{{ url('admin/reparations') }}" class="small-box-footer">
                 more info <i class="fas fa-arrow-circle-right"></i>
                 </a>
                </div>
            </div>

            <div class="col-md-4 mt-4">
                <div class="small-box" style="background-color: rgb(27, 178, 238)">
                 <div class="inner">
                     <h3>{{ \App\Models\Panne::count() }}</h3>
                     <p class="text-bold">Panne</p>
                 </div>
                 <div class="icon">
                     <i class="fas fa-hourglass-half"></i>
                 </div>
                 <a href="{{ url('admin/pannes') }}" class="small-box-footer">
                 more info <i class="fas fa-arrow-circle-right"></i>
                 </a>
                </div>
            </div>
          {{-- <div class="row my-5">
               <div class="col-md-6 mx-auto">
                @include('layouts.alert')
               </div>
          </div> --}}
           <div class="col-md-12">
            <div class="card my-3">
                <div class="card-header">
                   <div class="text-center font-weight-bold ">
    
                      <h4 class="btn btn-info">Panne</h4>
    
    
                    </div>
                  </div>
                  <div class="card-body">
                      <div class="col-lg-12">
                        <table id="myTable" class="table table-bordered table-striped  table-responsive-md table-hover">
                            <thead style="background-color: rgb(74, 74, 117); color:aliceblue">
                               <tr>
                                   <th>ID</th>
                                   <th>Numero Panne</th>
                                   <th>Date Panne</th>
                                   <th>Type Panne</th>
                                   <th>Matricule</th>
                                   <th>Action</th>
                                   
                           
                                   
                               </tr>
                            </thead>
                            <tbody>
                               @foreach ($pannes as $key => $panne)
                               <tr>
                                   <td>{{ $key+=1 }}</td>
                                   <td>{{ $panne->Numero_panne }}</td>
                                   <td>{{ $panne->Date_panne }}</td>
                                   <td>{{ $panne->Type_panne }}</td>
                                   <td>{{ $panne->vehicule->Matricule }}</td>
                                   <td class="d-flex justify-content-center align-items-center">
                                      
                                    <a href="javascript:void(0)"
                                    id="show-user"
                                    data-url="{{ route('pannes.show', $panne->id) }}"
                                    class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i>
                                     </a>
                                       
                                       <a href="{{ route('pannes.edit' , $panne->id) }}" 
                                          class="btn btn-sm btn-success mx-2">
                                          <i class="fas fa-edit"></i>
                                       </a>
                                       <form  id="{{ $panne->id }}" action="{{ route('pannes.destroy' , $panne->id) }}" method="post">
                           
                                           @csrf
                                           @method('DELETE')
                                       </form>
                                           <button  onclick="deleteEmp({{ $panne->id}})"
                                               type="submite" 
                                               class="btn btn-sm btn-danger">
                                               <i class="fas fa-trash"></i>
                                           </button>
                                   </td>
                                   
                               </tr>
                               @endforeach
                            </tbody>
                       </table>
                      </div>
                  </div>
              </div>
            </div>
           </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="userShowModal" tabindex="-1" role="dialog" aria-labelledby="userShowModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="userShowModal" style="font-weight: bold">Détails de panne</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card  mb-3" style="max-width: 30rem; background-color:rgb(136, 199, 55)">
                    <div class="card-header">Panne</div>
                    <div class="card-body">
                      {{-- <h5 class="card-title">détails de carburant</h5><br> --}}
                      <p><strong>Nemuro Panne:</strong> <span id="Numero_panne"></span></p>
                      <p><strong>Date Panne:</strong> <span id="Date_panne"></span></p>
                      <p><strong>Type Panne:</strong> <span id="Type_panne"></span></p>
                      <p><strong>ID_vehicule:</strong> <span id="vehicule_id"></span></p>
                    </div>
                  </div>
                 </div>
        </div>
                <!-- Add more user data here -->
            </div>
        </div>

@endsection

@section('js')
    <script>
        $(document).ready(function(){
            $('#myTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                 'excel', 'print', 'colvis'
                ]
            });
        });
    </script>
    @if (session()->has('success'))
    <script>
          
          Swal.fire({
          position: 'top-auto',
          icon: 'success',
          title: "{{ session()->get('success') }}",
          showConfirmButton: false,
          timer: 2500
          })
    
    </script>
        
    @endif

    

<script>
        function deleteEmp(id){
            Swal.fire({
                 title: 'Es-tu sûr?',
                 text: "Vous ne pourrez pas revenir en arrière !",
                 icon: 'warning',
                 showCancelButton: true,
                 confirmButtonColor: '#58d622',
                 cancelButtonColor: '#d33',
                 confirmButtonText: 'Oui, supprimez-le !'
                 }).then((result) => {
                 if(result.isConfirmed) {
                    document.getElementById(id).submit();
            Swal.fire(
                 'Supprimé !',
                 'Votre fichier a été supprimé.',
                 'success'
               )
             }
           })
        }
    </script>



<script>
       
    $(document).ready(function () {
        
        $('body').on('click', '#show-user', function () {
          var userURL = $(this).data('url');
          $.get(userURL, function (data) {
              $('#userShowModal').modal('show');
              $('#Numero_panne').text(data.Numero_panne);
              $('#Date_panne').text(data.Date_panne);
              $('#Type_panne').text(data.Type_panne);
              $('#vehicule_id').text(data.vehicule_id);
              
          })
       });
        
    });
   
</script>
    

@endsection