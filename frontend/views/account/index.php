<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'My Account';

?>
<h1><?= Html::encode($this->title) ?> - Dashboard</h1>

<div class="profile-index">
	<div class="row">
		<div class="col-sm-9">
			<p>Welcome <?= Yii::$app->user->identity->username; ?></p>
			<div class="clock">
				<div id="Date"></div>
				<span id="hours"> </span>
				<span id="point">:</span>
				<span id="min"> </span>
				<span id="point">:</span>
				<span id="sec"> </span>
			</div>
		</div>
		<div class="col-sm-3">
			<div id="google_search_bar">
				<gcse:searchbox-only newWindow=true></gcse:searchbox-only>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-3">
			<p>Work Live</p>
			<ul>
				<li><?= Html::a( 'RLL Admin', 'http://admin.rllinsure.com/site/dashboard', [ 'target'=>'_blank' ] ); ?></li>
				<li><?= Html::a( 'RLL Website', 'http://www.rllinsure.com', [ 'target'=>'_blank' ] ); ?></li>
				<li><?= Html::a( 'Marketing Website', 'http://marketing.rllinsure.com/wordpress', [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( 'RLL Marketing CMS', 'http://rllmarketingcms.rllinsure.com'); ?></li>
			</ul>

			<p>Work Dev</p>
			<ul>
				<li><?= Html::a( 'RLL New (dev)', 'http://mbarrusci.rllinsure.com', [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( 'RLL (dev)', 'http://mbarrus.rllinsure.com', [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( 'SLL (dev)', 'http://mbarrus.sllinsure.com', [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( 'RLL API (mean dev)', 'http://localhost:3001', [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( 'RLL Marketing CMS', 'http://rllmarketingcms.marcellusrocks.com'); ?></li>
			</ul>

			<p>Prototypes</p>
			<ul>
				<li><?= Html::a( 'SmartQualify (live)', 'http://smartqualify.aobex.com', [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( 'PMS', 'http://mbarrus.pms.com', [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( 'PMS Admin', 'http://mbarrusadmin.pms.com', [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( 'My Social', 'http://mbarrus.mysocial.com', [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( 'My Social Admin', 'http://mbarrus.mysacialadmin.com', [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( 'My Movie Collection', "http://movies.marcellusrocks.com", [ "target"=>"_blank" ] ); ?></li>
                <li><?= Html::a( 'Exams 4 Real Estate', "http://mbarru.exams4realestate.com", [ "target"=>"_blank" ] ); ?></li>
                <li><?= Html::a( 'Exams 4 Real Estate Admin', "http://mbarruadmin.exams4realestate.com", [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( 'My CMS Frontend', 'http://blog.marcellusrocks.com', [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( 'My CMS Backend', 'http://blogadmin.marcellusrocks.com', [ "target"=>"_blank" ] ); ?></li>


			</ul>

			<p>CRM</p>
			<ul>
				<li><?= Html::a( "Accounts", '/accounts' ); ?></li>
			</ul>


		</div>
		<div class="col-sm-3">
			<p>Work Links:</p>
			<ul>
				<li><?= Html::a( 'Jira', 'https://rllinsure.atlassian.net/secure/RapidBoard.jspa?rapidView=3&projectKey=RLL', [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( 'Bitbucket - RLL', 'https://bitbucket.org/rllinsure', [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( 'Confluence - RLL', 'https://rllinsure.atlassian.net/wiki/discover/all-updates', [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( "Yammer", 'https://www.yammer.com/rllinsure.com/#/threads/inGroup?type=in_group&feedId=6895143', [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( "Zoho CRM",'https://crm.zoho.com/crm/ShowHomePage.do?userLoggingIn=true', [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( "Zoho Support", 'https://support.zoho.com', [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( 'Hubstaff', 'https://hubstaff.com/dashboard/my', [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( "MRI Frontend", 'https://mrix1pc.saas.mrisoftware.com', [ "target"=>"_blank", "title"=>"Client ID: C069999, Username: RLLMB01, Password: Malaka2012" ] ); ?></li>
				<!-- li><?= Html::a( "SmartSheet", 'https://app.smartsheet.com/b/home', [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( "Basecamp", "http://www.basecamp.com", [ "target"=>"_blank" ] ); ?></li -->
			</ul>
			
			<p>Reference Links</p>
			<ul>
				<li><?= Html::a( 'Google', 'http://www.google.com', [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( 'Geocaching', 'http://www.geocaching.com', [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( 'UTAG', 'http://www.utahcacher.com', [ "target"=>"_blank" ] ); ?></li>
			</ul>
			<p>Social Media</p>
			<ul>
				<li><?= Html::a( 'Twitter', 'http://www.twitter.com', [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( 'Facebook', 'http://www.facebook.com', [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( 'LinkdIn', 'http://www.linkdin.com', [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( 'Pinterest', 'http://www.pinterest.com', [ "target"=>"_blank" ] ); ?></li>
			</ul>
			<p>Email:</p>
			<ul>
				<li><?= Html::a( 'GMail', 'http://www.gmail.com', [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( 'Yahoo Mail', 'http://mail.yahoo.com', [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( 'Office 365', 'https://outlook.office365.com', [ "target"=>"_blank" ] ); ?></li>
			</ul>

		</div>
		<div class="col-sm-3">
			<p>Developer Reference</p>
			<ul>
				<li><?= Html::a( 'Amazon AWS', 'http://aws.amazon.com', [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( 'Laravel', 'http://www.laravel.com', [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( 'PHP', 'http://www.php.net', [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( 'Twitter Bootstrap', 'http://www.getbootstrap.com', [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( 'Bootstrap Validator', 'http://bootstrapvalidator.com/getting-started/', [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( "Bootstrap Validator - Validators", "http://bootstrapvalidator.com/validators/", [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( 'CodeIgniter User Guide', 'http://ellislab.com/codeigniter/user-guide', [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( 'JQuery', 'http://www.jquery.com', [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( 'Yii', 'http://www.yiiframework.com/doc-2.0/guide-README.html', [ "target"=>"_blank" ] ); ?></li>
			</ul>
			<p>PHP MyAdmin</p>
			<ul>
				<li><?= Html::a( 'phpmyadmin (live)', 'http://admin.rllinsure.com/phpmyadmin/', [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( 'phpmyadmin (AWS)', 'http://aws.rllinsure.com/phpmyadmin/', [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( 'phpmyadmin (local)', 'http://mbarrus.marcellusrocks.com/phpmyadmin/', [ "target"=>"_blank" ] ); ?></li>
			</ul>

		</div>
		<div class="col-sm-3">
			<p>Finances</p>
			<ul>
				<li><?= Html::a( 'America First Credit Union', 'http://www.americafirst.com', [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( 'Fidelity', 'http://www.fidelity.com', [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( "RLL Pay Roll", "http://myaccess.adp.com/", ["target"=>"_blank" ] ); ?>
			</ul>
            <p>Monthly Bills & Utilities</p>
            <ul>
                <li><?= Html::a( "Rocky Mountain Power", "https://www.rockymountainpower.net/index.html", [ 'target'=>"_blank" ] ); ?></li>
                <li><?= Html::a( "Questar Gas/Dominion Energy", "https://www.dominionenergy.com/", [ 'target'=>"_blank" ] ); ?></li>
                <li><?= Html::a( "City of West Jordan", "wjordan.com", [ 'target'=>"_blank" ] ); ?></li>
                <li><?= Html::a( "Honda Financial", "http://www.hondafinancialservices.com/", [ 'target'=>"_blank" ] ); ?></li>
                <li><?= Html::a( "Ditech Home Mortgage", "https://www.ditech.com", [ 'target'=>"_blank" ] ); ?></li>
            </ul>
			<p>Debt & Credit Cards</p>
			<ul>
				<li><?= Html::a( 'CitiCards', 'http://www.citicards.com', [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( 'Walmart', 'https://www2.onlinecreditcenter6.com/consumergen2/login.do?accountType=generic&clientId=walmart&langId=en&subActionId=1000', [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( 'CapitalOne', 'http://www.capitalone.com', [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( 'Cabela\'s Club Card', 'http://www.cabelasclubvisa.com', [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( 'PayPal', 'http://www.paypal.com', [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( "fedLoan Services", "https://myfedloan.org", ['target'=>"_blank" ] ); ?></li>
				<li>Goodyear</li>
			</ul>
			<p>Debt & Credit Cards - Paid</p>
			<ul>
				<li><?= Html::a( 'Citi Mortgage', 'http://www.citimortgage.com', [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( 'Jared', 'http://www.jared.com', [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( 'BestBuy', 'https://www.accountonline.com/cards/svc/LoginGet.do?siteId=PLCN_BESTBUY', [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( 'Home Depot', 'https://www.accountonline.com/cards/svc/LoginGet.do?siteId=HOMEDEPOT&cm_sp=credit_center-_-frag1-_-col1-2-_-make_a_payment', [ "target"=>"_blank" ] ); ?></li>
				<li><?= Html::a( 'RC Willey', 'http://www.rcwilley.com', [ "target"=>"_blank" ] ); ?></li>
                <li><?= Html::a( "Amazon Visa - Chase", "https://secure07c.chase.com/web/auth/dashboard#/dashboard/creditCardAccounts/overviewDashboard/singleCard", [ 'target'=>"_blank" ] ); ?></li>
                <li>Ashley Furniture - Synchrony Bank</li>
                <li>CareCredit - Synchrony Bank</li>
                <li>Murdock Music - Synchrony Bank</li>
			</ul>
		</div>
	</div>
</div>
