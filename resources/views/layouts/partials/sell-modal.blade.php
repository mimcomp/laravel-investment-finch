<!-- Sell Modal -->
<div id="sellModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Sell </h4>
			</div>
			<div class="modal-body">
				<!-- Add Stock to Portfolio -->
				<form role="form" action="{{action('PortfolioController@update', ['id' => $selectedPortfolio->id])}}" method="POST">
					<input type="hidden" name="_method" value="put"/>
					<input type="hidden" name="tradeType" value="sell"/>
					{{ csrf_field() }}
					<div class="row">
						<label class="col-sm-2 single-px-padding-right" for="saleStockCode">Stock Code</label>
						<label class="col-sm-2 single-px-padding-left-right" for="salePrice">Sale Price</label>
						<label class="col-sm-2 single-px-padding-left-right" for="saleQuantity">Quantity</label>
						<label class="col-sm-2 single-px-padding-left-right" for="saleBrokerage">Brokerage</label>
						<label class="col-sm-3 single-px-padding-left-right" for="saleDate">Sale Date</label>
					</div>
					<div class="row row-no-margin-right">
						<div class="col-sm-2 single-px-padding-right">
							<input name="saleStockCode" id="saleStockCode" type="text" class="form-control{{ $errors->has('saleStockCode') ? ' has-error' : ''}}" 
							placeholder="Code" maxlength="3" readonly="true" value={{ old('saleStockCode') }}>
						</div>
						<div class="col-sm-2 single-px-padding-left-right">
							<div class="input-group">
								<div class="input-group-addon">$</div>
								<input name="salePrice" id="salePrice" type="text" class="form-control{{ $errors->has('salePrice') ? ' has-error' : ''}}" value={{ old('salePrice') }}>
							</div>
						</div>
						<div class="col-sm-2 single-px-padding-left-right">
							<input name="saleQuantity" id="saleQuantity" type="text" class="form-control{{ $errors->has('saleQuantity') ? ' has-error' : ''}}" value={{ old('saleQuantity') }}>
						</div>
						<div class="col-sm-2 single-px-padding-left-right">
							<div class="input-group">
								<div class="input-group-addon">$</div>
								<input name="saleBrokerage" id="saleBrokerage" value="19.95" type="text" class="form-control{{ $errors->has('saleBrokerage') ? ' has-error' : ''}}" value={{ old('saleBrokerage') }}>
							</div>
						</div>
						<div class="col-sm-3 single-px-padding-left-right">
							<input name="saleDate" id="saleDate" type="date" class="form-control{{ $errors->has('saleDate') ? ' has-error' : ''}}" value={{ old('saleDate') }}>
						</div>
						<div class="col-sm-1 single-px-padding-left">
							<button type="submit" class="btn btn-default">Add</button>
						</div>
					</div>
				</form>
				@if($errors->has('stockCode') || $errors->has('salePrice') || $errors->has('saleQuantity') || $errors->has('saleBrokerage') || $errors->has('saleDate'))
					<!-- Display Modal if errors are present -->
					<script type="text/javascript">
					    $('#sellModal').modal('show');
					</script>
					<div class="col-sm-12 default-margin-top">
						<div class="alert alert-danger three-quarter-margin-bottom">
							<ul>
					            @foreach ($errors->all() as $error)
					                <li>{{ $error }}</li>
					            @endforeach
					        </ul>
						</div>
					</div>
				@endif
				@if(Session::has('sellPortfolioError'))
					<script type="text/javascript">
					    $('#sellModal').modal('show');
					</script>
					<div class="col-sm-12 default-margin-top">
						<div class="alert alert-danger three-quarter-margin-bottom">
							<ul>
					            <li>{{ Session('sellPortfolioError') }}</li>
					        </ul>
						</div>
					</div>
				@endif
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<script>
	//Sell Modal contents
	$("#sellModal").on('show.bs.modal', function(e){
		var stockCode = e.relatedTarget.dataset.stockcode;
		var salePrice = e.relatedTarget.dataset.currentprice
		$(e.currentTarget).find('input[name="saleStockCode"]').val(stockCode);
		$(e.currentTarget).find('input[name="salePrice"]').val(salePrice);
	})
</script>