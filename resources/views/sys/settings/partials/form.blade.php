@php
  $val = fn($key, $default='') => old($key, $item?->{$key} ?? $default);
@endphp

<div class="row g-3">
  <div class="col-md-6">
    <label class="form-label" for="CompanyName">Organization Name</label>
    <input class="form-control" id="CompanyName" name="CompanyName" value="{{ $val('CompanyName') }}" />
  </div>

  <div class="col-md-6">
    <label class="form-label" for="Email">E-mail</label>
    <input class="form-control" id="Email" name="Email" value="{{ $val('Email') }}" />
  </div>

  <div class="col-md-3">
    <label class="form-label" for="Code">Code (+256)</label>
    <input class="form-control" id="Code" name="Code" value="{{ $val('Code') }}" />
  </div>

  <div class="col-md-4">
    <label class="form-label" for="Phone">Phone Number</label>
    <input class="form-control" id="Phone" name="Phone" value="{{ $val('Phone') }}" />
  </div>

  <div class="col-md-5">
    <label class="form-label" for="Phone2">Phone Number No.2</label>
    <input class="form-control" id="Phone2" name="Phone2" value="{{ $val('Phone2') }}" />
  </div>

  <div class="col-md-4">
    <label class="form-label" for="Plot">Plot No.</label>
    <input class="form-control" id="Plot" name="Plot" value="{{ $val('Plot') }}" />
  </div>

  <div class="col-md-8">
    <label class="form-label" for="Address">Address</label>
    <input class="form-control" id="Address" name="Address" value="{{ $val('Address') }}" />
  </div>

  <div class="col-md-6">
    <label class="form-label" for="Country">Country</label>
    <select id="Country" name="Country" class="form-select">
      @php $country = $val('Country'); @endphp
      <option value="{{ $country }}">{{ $country ?: 'Select country' }}</option>
      <option value="Uganda">Uganda</option>
      <option value="Kenya">Kenya</option>
      <option value="Tanzania">Tanzania</option>
      <option value="United States">United States</option>
      <option value="United Kingdom">United Kingdom</option>
      <option value="United Arab Emirates">United Arab Emirates</option>
      <option value="South Africa">South Africa</option>
      <option value="Sierra Leone">Sierra Leone</option>
      <option value="Turkey">Turkey</option>
      <option value="Thailand">Thailand</option>
    </select>
  </div>

  <div class="col-md-6">
    <label class="form-label" for="Currency">Currency</label>
    <select id="Currency" name="Currency" class="form-select">
      @php $currency = $val('Currency'); @endphp
      <option value="{{ $currency }}">{{ $currency ?: 'Select currency' }}</option>
      <option value="UGX">UGX</option>
      <option value="KSH">KSH</option>
      <option value="TZX">TZX</option>
      <option value="USD">USD</option>
      <option value="Euro">Euro</option>
      <option value="Pound">Pound</option>
      <option value="SLL">Leones</option>
    </select>
  </div>
</div>
