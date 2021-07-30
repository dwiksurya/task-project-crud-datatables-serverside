<x-modal>
    <div class="form-group row">
        <label for="merchant_name mb-2" class="col-lg-2 col-lg-offset-1 control-label">Merchant Name</label>
        <div class="col-lg-6">
            <input type="text" name="merchant_name" id="merchant_name" class="form-control" placeholder="Clothes Store" required autofocus>
            <span class="help-block with-errors"></span>
        </div>
    </div>
    <div class="form-group row">
        <label for="country_code" class="col-lg-2 col-lg-offset-1 control-label">Country Code</label>
        <div class="col-lg-6">
            <input maxlength="2" type="text" name="country_code" id="country_code" class="form-control" placeholder="ID" required autofocus>
            <span class="help-block with-errors"></span>
        </div>
    </div>
</x-modal>