@extends('layouts.swinedefault')

@section('title')
	Grower Records
@endsection

@section('content')
	<div class="container">
		<h4>Grower Records</h4>
		<div class="divider"></div>
		<div class="row" style="padding-top: 10px;">
			<div class="col s12">
        <ul class="tabs tabs-fixed-width green lighten-1">
          <li class="tab col s6"><a href="#addsowbreedersview">Sows</a></li>
          <li class="tab col s6"><a href="#addboarbreedersview">Boars</a></li>
        </ul>
      </div>
      <div id="addsowbreedersview" class="col s12">
				<table class="centered">
					<thead>
						<tr>
							<th>Registration ID</th>
							<th>Birth weight, kg</th>
							<th>Weaning weight, kg</th>
							<th>Weight Record</th>
							<th>Add as Breeder</th>
						</tr>
					</thead>
					<tbody>
						@foreach($sows as $sow)
							<tr id="{{ $sow->registryid }}">
								<td>{{ $sow->registryid }}</td>
								@if(!is_null($sow->getAnimalProperties()->where("property_id", 53)->first()))
									<td>{{ $sow->getAnimalProperties()->where("property_id", 53)->first()->value }}</td>
								@else
									<td>No data available</td>
								@endif
								@if(!is_null($sow->getAnimalProperties()->where("property_id", 54)->first()))
									<td>{{ $sow->getAnimalProperties()->where("property_id", 54)->first()->value }}</td>
								@else
									<td>No data available</td>
								@endif
								@if($sow->weightrecord == 0)
                  <td>
                    <a href="{{ URL::route('farm.pig.weight_records_page', [$sow->id]) }}"><i class="material-icons">add_circle_outline</i></a>
                  </td>
                @elseif($sow->weightrecord == 1)
                  <td>
                    <a href="{{ URL::route('farm.pig.edit_weight_records_page', [$sow->id]) }}"><i class="material-icons">edit</i></a>
                  </td>
                @endif
								<td>
									<p>
							      <label>
							        <input type="checkbox" class="filled-in add_sow_breeder" value="{{ $sow->registryid }}" />
							        <span></span>
							      </label>
							    </p>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div id="addboarbreedersview" class="col s12">
				<table class="centered">
					<thead>
						<tr>
							<th>Registration ID</th>
							<th>Birth weight, kg</th>
							<th>Weaning weight, kg</th>
							<th>Weight Record</th>
							<th>Add as Breeder</th>
						</tr>
					</thead>
					<tbody>
						@foreach($boars as $boar)
							<tr id="{{ $boar->registryid }}">
								<td>{{ $boar->registryid }}</td>
								@if(!is_null($boar->getAnimalProperties()->where("property_id", 53)->first()))
									<td>{{ $boar->getAnimalProperties()->where("property_id", 53)->first()->value }}</td>
								@else
									<td>No data available</td>
								@endif
								@if(!is_null($boar->getAnimalProperties()->where("property_id", 54)->first()))
									<td>{{ $boar->getAnimalProperties()->where("property_id", 54)->first()->value }}</td>
								@else
									<td>No data available</td>
								@endif
								@if($boar->weightrecord == 0)
                  <td>
                    <a href="{{ URL::route('farm.pig.weight_records_page', [$boar->id]) }}"><i class="material-icons">add_circle_outline</i></a>
                  </td>
                @elseif($boar->weightrecord == 1)
                  <td>
                    <a href="{{ URL::route('farm.pig.edit_weight_records_page', [$boar->id]) }}"><i class="material-icons">edit</i></a>
                  </td>
                @endif
								<td>
									<p>
							      <label>
							        <input type="checkbox" class="filled-in add_boar_breeder" value="{{ $boar->registryid }}" />
							        <span></span>
							      </label>
							    </p>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	<script>
		$(document).ready(function(){
		  $(".add_sow_breeder").change(function () {
		    if($(this).is(":checked")){
					event.preventDefault();
					var breederid = $(this).val();
					$.ajax({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						},
						url: '../farm/fetch_breeders/'+breederid,
						type: 'POST',
						cache: false,
						data: {breederid},
						success: function(data)
						{
							Materialize.toast(breederid+' added as breeder!', 4000);
							$("#"+breederid).remove();
						}
					});
			  }
		  });
		  $(".add_boar_breeder").change(function () {
		    if($(this).is(":checked")){
					event.preventDefault();
					var breederid = $(this).val();
					$.ajax({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						},
						url: '../farm/fetch_breeders/'+breederid,
						type: 'POST',
						cache: false,
						data: {breederid},
						success: function(data)
						{
							Materialize.toast(breederid+' added as breeder!', 4000);
							$("#"+breederid).remove();
						}
					});
			  }
		  });
		});
	</script>
@endsection