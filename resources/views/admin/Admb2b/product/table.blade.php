 <table class="table data-tables"  id="table">

                  

                  <tbody id="tbody" >

                     @foreach ($products as $value)

                     <tr>
                        <td>{{$value->updated_at}}</td>

                        <td>{{'#'.$value->product_number}}</td>
                        
                        <td>{{$value->company_name}}</td>

                        <td>

                           @if($value->main_image == "")

                              <img src="{{url('assets/images/noimage.png')}}" class="誰mg table-img">

                           @else

                              <img src="{{url('assets/images/upload/'.explode(",",$value->main_image)[0])}}" class="誰mg table-img">

                           @endif

                        </td>                        

                        <td>{{$value->name}}</td>
                        
                        
                            @if($value->status=='1')
                            <td><span class="badge badge-success">Approved</span></td>
                            @elseif($value->status=='Pending')
                            <td><span class="badge badge-warning">Pending</span></td>
                            @elseif($value->status=='0')
                            <td><span class="badge badge-danger">Disapproved</span></td>
                            @else
                            <td><span class="badge badge-warning">Pending</span></td>
                            @endif
                        
                       

                        <td><span class="text-danger"><strike> {{$value->regular_price}} </strike></span> {{$value->sale_price}} USD</td>

                       <td><input data-id="{{$value->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Yes" data-off="No" {{ $value->featured ? 'checked' : '' }}></td>

                       <!-- <td>{{$value->stock.'pc.'}}</td>  -->                     

                        <td>

                            <a href='{{url('product/'.encrypt($value->id))}}' class='btn btn-primary btn-sm'> <i class="fa fa-edit"></i></a>

                            <a href='{{url('productDetail/'.encrypt($value->id))}}' class='btn btn-warning btn-sm'> <i class="fa fa-eye"></i></a>

                            <a href='{{url('productgallery/'.encrypt($value->id))}}' class='btn btn-info btn-sm'> <i class="fa fa-image"></i></a>
                            
                             @if($value->status=='Pending')
                            <a href='{{url('productapprove/'.encrypt($value->id))}}' class='btn btn-success btn-sm'><i class="fa fa-thumbs-up" aria-hidden="true"></i>
</a>
                            <a href='{{url('productdisapprove/'.encrypt($value->id))}}' class='btn btn-danger btn-sm'><i class="fa fa-thumbs-down" aria-hidden="true"></i></a>
                            
                            @elseif($value->status=='0')
                            <a href='{{url('productapprove/'.encrypt($value->id))}}' class='btn btn-success btn-sm'><i class="fa fa-thumbs-up" aria-hidden="true"></i>
</a>
                            
                            @else
                            <a href='{{url('productdisapprove/'.encrypt($value->id))}}' class='btn btn-danger btn-sm'><i class="fa fa-thumbs-down" aria-hidden="true"></i></a>
                            @endif

                        </td>

                     </tr>
                     

                        
                     @endforeach

                  </tbody>

               </table>