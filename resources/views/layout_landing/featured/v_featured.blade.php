<div class="untree_co--site-section">
    <div class="container">
      <div class="container pt-0 pb-5">
      <div class="row justify-content-center text-center">
        <div class="col-lg-6 section-heading" data-aos="fade-up">
          <h3 class="text-center">Bookg Your Makeup NOW!!</h3>
        </div>
      </div>
    </div>
      <div class="row custom-row-02192 align-items-stretch">
        @foreach ($content as $item )
        <div class="col-md-6 col-lg-4 mb-5" data-aos="fade-up" data-aos-delay="100">
          <div class="media-29191 text-center h-100">
            <div class="media-29191-icon">
              <img src="{{ asset('') . $item->getMakeup->image }}" style="width:60px;height:60;" alt="Image" class="img-fluid">
            </div>
            <h3>{{$item->getMakeup->name}}</h3>
            <p>{{$item->getMakeup->description}}</p>
            <h5>Rp.{{ number_format($item->getMakeup->price, 0, ',', '.') }}</h5>
            <p><p><a href="#" data-toggle="modal" data-target="#exampleModal{{$item->getMakeup->id}}" class="readmore reverse">Book Now!</a></p></p>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>


  {{-- modal begin --}}
  @foreach ($content as $edit )
  <div class="modal fade" id="exampleModal{{$edit->getMakeup->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{url('/booking')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Event</label>
                        <input type="text" class="form-control" name="name_event" placeholder="Masukkan Nama Event">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Makeup</label>
                        <input type="hidden" name="makeup" value="{{$edit->getMakeup->id}}" class="form-control">
                        <input type="text" value="{{$edit->getMakeup->name}}" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Deskripsi Makeup</label>
                        <input type="text" value="{{$edit->getMakeup->description}}" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Harga</label>
                        <input type="hidden" name="price" value="{{$edit->getMakeup->price }}" class="form-control">
                        <input type="text" value="Rp.{{ number_format($edit->getMakeup->price, 0, ',', '.') }}" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Type Makeup</label>
                        <select name="type_makeup" id="type_makeup" class="form-control">
                            <option value="">-Pilih-</option>
                            @foreach ($edit->getMakeup->detailMakeup as $item )
                            <option value="{{$item->getType->id}}">
                                {{$item->getType->name}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                            <label for="appointmentDate">Tanggal Makeup</label>
                            <input type="date" class="form-control" name="date" required>
                    </div>
                    <div class="form-group">
                            <label for="waktu">Waktu</label>
                            <input type="time" class="form-control" name="waktu" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

  @endforeach
