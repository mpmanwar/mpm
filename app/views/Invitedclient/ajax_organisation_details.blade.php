<ul>
<li>
    <div class="vat_section_main">
      <div class="head_section">VAT RETURNS</div>
      <div class="vat_section_content">
        <ul>
          <li>Vat Number : {{ $client_details['vat_number'] or "" }}</li>
          <li>Registration Date : {{ $client_details['effective_date'] or "" }}</li>
          <li>Scheme : {{ $client_details['vat_scheme_type'] or "" }}</li>
          <li>Cycle : {{ $client_details['ret_frequency'] or "" }}</li>
          <li>Vat Months (Stagger) : {{ $client_details['vat_stagger'] or "" }}</li>
          <li><a href="#" class="edit_icon"><img alt="" src="img/edit_icon.png"></a></li>
        </ul>
      </div>
    </div>
  </li>
  <li>
    <div class="vat_section_main">
      <div class="head_section">ANNUAL ACCOUNTS</div>
      <div class="vat_section_content">
        <ul>
          <li>Companies House Number : {{ $client_details['registration_number'] or "" }}</li>
          <li>Year End Accounts Date : {{ $client_details['acc_ref_day'] or "" }}/{{ $client_details['acc_ref_month'] or "" }}</li>
          <li>Accounts Filing Deadline : {{ $client_details['next_acc_due'] or "" }}</li>
          <li>Days to Deadline : {{ $client_details['deadacc_count'] or "" }}</li>
          <li><a href="#" class="edit_icon"><img alt="" src="img/edit_icon.png"></a></li>
        </ul>
      </div>
    </div>
  </li>
  <li>
    <div class="vat_section_main">
      <div class="head_section">PERSONAL TAX PAYMENT ON ACCOUNT</div>
      <div class="vat_section_content">
        <ul>
          <li>Unique Taxpayer Reference (UTR) Number : {{ $logged_client_details['tax_reference'] or "" }}</li>
          <li>First Payment on Account : 31st January {{ date('Y', strtotime('+1 year')); }}</li>
          <li>Second Payment on Account : 31st July {{ date('Y', strtotime('+1 year')); }}</li>
          <li>Balancing Payment : 31st January {{ date('Y', strtotime('+2 year')); }}</li>
          <li><a href="#" class="edit_icon"><img alt="" src="img/edit_icon.png"></a></li>
        </ul>
      </div>
    </div>
  </li>
  <li>
    <div class="vat_section_main">
      <div class="head_section">COMPANIE'S HOUSE ANNUAL RETURNS</div>
      <div class="vat_section_content">
        <ul>
          <li>Authetication Code : {{ $client_details['ch_auth_code'] or "" }}</li>
          <li>Companies House Number : {{ $client_details['registration_number'] or "" }}</li>
          <li>Annual Return Date : {{ $client_details['next_ret_due'] or "" }}</li>
          <li>Filing Deadline : {{ $client_details['next_acc_due'] or "" }}</li>
          <li>Days to Deadline : {{ $client_details['deadret_count'] or "" }}</li>
          <li><a href="#" class="edit_icon"><img alt="" src="img/edit_icon.png"></a></li>
        </ul>
      </div>
    </div>
  </li>
  <li>
    <div class="vat_section_main">
      <div class="head_section">INCOME TAX RETURNS</div>
      <div class="vat_section_content">
        <ul>
          <li>Unique Taxpayer Reference (UTR) Number : {{ $client_details['tax_reference'] or "" }}</li>
          <li>Tax Return Filing Date (Online) : 31/01/{{ date('Y', strtotime('+1 year')); }}</li>
          <li>Tax Return Filing Date (Paper) : 31/10/{{ date('Y') }}</li>
          <li><a href="#" class="edit_icon"><img alt="" src="img/edit_icon.png"></a></li>
        </ul>
      </div>
    </div>
  </li>
  <li>
    <div class="vat_section_main">
      <div class="head_section">PAY/NICS</div>
      <div class="vat_section_content">
        <ul>
          <li>PAYE Reference : {{ $client_details['paye_reference'] or "" }}</li>
          <li>Accounts Office Reference : {{ $client_details['acc_office_ref'] or "" }}</li>
          <li>Online Payment Due Date : 22nd of {{ date("F") }}</li>
          <li>Cheque Payment Due Date : 19th of {{ date("F") }}</li>
          <li><a href="#" class="edit_icon"><img alt="" src="img/edit_icon.png"></a></li>
        </ul>
      </div>
    </div>
  </li>
  <li>
    <div class="vat_section_main">
      <div class="head_section">P11DS</div>
      <div class="vat_section_content">
        <ul>
          <li>PAYE Reference : {{ $client_details['paye_reference'] or "" }}</li>
          <li>Accounts Office Reference : {{ $client_details['acc_office_ref'] or "" }}</li>
          <li>P11D Return Date : 7th of July</li>
          <li>Class 1A Payment Date : 22nd of July</li>
          <li><a href="#" class="edit_icon"><img alt="" src="img/edit_icon.png"></a></li>
        </ul>
      </div>
    </div>
  </li>
  <li>
    <div class="vat_section_main">
      <div class="head_section">BUSINESS TAX RETURNS</div>
      <div class="vat_section_content">
        <ul>
          <li>Tax Reference Number : {{ $client_details['tax_reference'] or "" }}</li>
          <li>Tax Return Date : </li>
          <li>Tax Due Date : </li>
          <li><a href="#" class="edit_icon"><img alt="" src="img/edit_icon.png"></a></li>
        </ul>
      </div>
    </div>
  </li>
  <li>
    <div class="vat_section_main">
      <div class="head_section">EC SALES LIST</div>
      <div class="vat_section_content">
        <ul>
          <li>Quarter 1 - Jan - March Due 14th April</li>
          <li>Quarter 2 - April - June  ue 14th July</li>
          <li>Quarter 3 - July - Sept Due 14th Oct</li>
          <li>Quarter 4 - Oct Dec Due 14th Jan</li>
        </ul>
      </div>
    </div>
  </li>
  <li>
    <div class="vat_section_main">
      <div class="head_section">HMRC PAYMENT PLAN DATES</div>
      <div class="vat_section_content">
        <ul>
          <li>
            <a href="#">Add</a>
          </li>
          <li>
            <!-- <a href="#" class="edit_icon"><img alt="" src="img/edit_icon.png"></a> -->
          </li>
        </ul>
      </div>
    </div>
  </li>
</ul>