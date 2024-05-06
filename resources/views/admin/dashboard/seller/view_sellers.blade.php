@section('title',"view sellers")
@include('components.admin-header')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Sellers </li>
                    </ol>
                </nav>
            </div>
            
        </div>
        <!--end breadcrumb-->
      
        <div class="card">
            <div class="card-body">
                <div class="d-lg-flex align-items-center mb-4 gap-3">
                    {{-- <div class="position-relative">
                        <input type="text" class="form-control ps-5 radius-30" placeholder="Search category"> <span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
                    </div> --}}
                  <div class="ms-auto"><a href="{{route('seller.addCategoryPage')}}" class="btn btn-sm btn-primary mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i>Add New Order</a></div>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0" id="myTable">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>username</th>
                                <th>Status</th>
                                <th>Registration Date</th>
                                <th>Edit </th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @php 
                            $no = 1;
                            @endphp
                            @if(count($seller)>0)
                                @foreach($seller as $perSeller)
                                <tr id="{{$perSeller->sellerId}}">
                                <td>
                                     <div class="d-flex align-items-center">
                                        <div class="ms-2">
                                            <h6 class="mb-0 font-14">{{$no++}}</h6>
                                        </div>
                                    </div>
                                </td>
                            
                                <td>{{$perSeller->username}}</td>
                                         {{-- <a href=""> <td><div class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3"><i class='bx bxs-circle me-1'></i>Pending</div></td></a> --}}
                                <td> <a href=""> <div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"><i class='bx bxs-circle me-1'></i>Success</div></a></td>
                                <td>{{ date_format($perSeller->created_at,'d-M-Y') }}</td>
                                <td>
                                    <div class="d-flex order-actions">
                                        <a href="" class=""><i class='bx bxs-edit'></i></a>
                                     </div>
                                </td>
                            </tr>
                                @endforeach
                            @else
                            <tr>
                                <td class="text-center text-danger" colspan="5"><b>Empty Category </b> </td>
                            </tr>
                            
                            @endif									
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
</div>
<!--end page wrapper -->
<!--start overlay-->
<!--end overlay-->
<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
<!--End Back To Top Button-->

</div>
@include('components.admin-footer')
<script>
	let table = new DataTable('#myTable');
</script>