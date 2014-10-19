@extends('front.master')

@section('content')

<header class="board-top">
	<div class="container">
		<a href="{{ URL::to('/') }}" class="logo-main">hashtag.info</a>
		<div class="board-top-search">
			{{ Form::open(array('url' => 'szukaj')) }}
				<div class="input-prepend">
					<div class="input-icon">
						<i class="fa fa-search"></i>
					</div>
					<div class="input-with-icon">
						<input type="text" class="input-default" name="query" placeholder="Wpisz dowolny hasztag">
					</div>
				</div>
				<input type="submit" value="Szukaj">
			{{ Form::close() }}
		</div>
		<nav class="nav-user">
			 @include('user.user-nav')
		</nav>
	</div>
</header>

<div class="container">
	<div class="page-with-padding">
		<h1>Regulamin</h1>

		<div class="page-content">
				<h2>Tagboard Terms of Service</h2>

				<h3>I.	What we are.</h3>
				<p>Tagboard is a social media hub for hashtags. Tagboard searches multiple social networks for posts with a hashtag and aggregates and displays them for the user. With Tagboard, you see and interact with the whole conversation, across networks, making us a perfect hub for social media. These Terms of Service (“TOS”) govern your access to and use of Tagboard’s website and associated services (“Tagboard”). By using Tagboard, you agree to be bound by these TOS.
				</p>
				<h3>II.	How to use.</h3>
				<p>A.	To proceed, you must have a binding contract with Tagboard in compliance with these TOS and all applicable laws. Subject to these TOS and our policies, we grant you a limited, non-exclusive, non-transferable, and revocable license to use Tagboard. Once you agree to these TOS, explore and enjoy Tagboard.<br>
				B.	Tagboard may include software that is downloaded to your computer, phone, tablet, or other device. You agree that we may automatically upgrade that software, and these TOS will apply to such upgrades.  
				</p>

				<h3>III.	Tagboard Content.</h3>
				<p>A.	Tagboard provides an open air, generally unmoderated aggregation of photographs, thoughts, links, posts, and similar information that illuminates, describes, collects, conglomerates and/or explains a particular subject or category of interest.  Collectively, we call these aggregated materials “Tagboard Content.”  Tagboard Content includes materials from third-party websites, links to third-party websites, and third-party social networks (collectively, the “Networks”) that are not owned or controlled by Tagboard. Tagboard has no control over, and assumes no responsibility for, the content, privacy policies, or practices of any third-party websites or the Networks. In addition, Tagboard does not assume responsibility to censor or edit the content of any third-party site. By using Tagboard, you expressly relieve Tagboard from any and all liability arising from the Tagboard Content and/or from your use of any third-party website.  Accordingly, we encourage you to be aware when you view Tagboard Content and/or leave Tagboard through such third-party links or otherwise that you must read and follow the terms and conditions and privacy policy of each other website or Networks that you visit. <br>
				B.	Tagboard Content is provided to you AS IS. You may access Tagboard for your information and personal use solely as intended through the provided functionality of Tagboard and as permitted under these TOS. You shall not download, copy, reproduce, distribute, transmit, broadcast, display, embed, sell, license, or otherwise exploit any Tagboard Content for any purpose without the prior written consent of Tagboard or the respective licensors and/or owners of the content. Tagboard reserves all rights not expressly granted in and to the content therein.<br>
				C.	You understand that when using Tagboard, you will be exposed to Tagboard Content collected from a variety of sources, and that Tagboard is not responsible for the accuracy, usefulness, safety, or intellectual property rights of or relating to such Tagboard Content. You further understand and acknowledge that you may be exposed to Tagboard Content that is inaccurate, offensive, indecent, or objectionable, and you agree to waive, and hereby do waive, any legal or equitable rights or remedies you have or may have against Tagboard with respect thereto, and, to the extent permitted by applicable law, agree to indemnify and hold harmless Tagboard, its owners, operators, affiliates, licensors, and licensees to the fullest extent allowed by law regarding all matters related to your use of Tagboard.<br>
				D.	Tagboard may contain links to third-party websites, advertisers, services, special offers, or other events or activities that are not owned or controlled by Tagboard. We do not endorse or assume any responsibility for any such third-party sites, information, materials, products, or services. If you access any third-party website, service, content, or Network from Tagboard, you do so at your own risk and you agree that Tagboard will have no liability arising from your use of or access to any third-party website, service, content, or Network. Tagboard makes no guarantees for the validity, security or safety of any outgoing links found within third-party content. 
				</p>

				<h3>IV.	What to post.</h3>
				<p>A.	Tagboard allows you to view Tagboard Content and effectively post your own content, including photos, comments, and other materials. <br>
				B.	You grant Tagboard and its users a non-exclusive, royalty-free, transferable, sublicensable, worldwide license to use, cache, display, reproduce, collect, tabulate, modify, create derivative works, perform, and distribute your content on Tagboard solely for the purposes of operating, developing, providing, and using Tagboard. Nothing in these TOS shall restrict other legal rights Tagboard may have to your content, for example under other licenses. We reserve the right to remove or modify your content for any reason, including that content that we believe violates these TOS or our policies.<br>
				C.	Tagboard provides a vehicle to view and explore topics of interest that are collected, aggregated and displayed as Tagboard Content. You agree that you will use Tagboard in a manner consistent with the TOS.<br>
				D.	You agree to post content that is consistent with the terms of the various Networks which Tagboard aggregates and arrays into a transformative visual mosaic as Tagboard Content:<br>
				http://www.facebook.com/legal/terms<br>
				https://www.flickr.com/services/api/tos/<br>
				http://instagram.com/legal/terms/<br>
				https://twitter.com/tos<br>
				E.	Likewise, developers on these Networks (such as us) agree to the terms of the respective application programming interfaces (API) as follows:<br>
				http://developers.facebook.com/<br>
				https://www.flickr.com/services/api/tos/<br>
				http://instagram.com/developer/<br>
				https://dev.twitter.com/<br>
				</p>
				<h3>V.	What not to post.</h3>
				<p>A.	Do not post information to Tagboard or maintain or use your Tagboard Page in a manner that directly or indirectly: (1) violates the intellectual property rights, privacy rights, publicity rights, or other personal or proprietary rights of any person or entity; (2) creates a risk of harm, loss, physical or mental injury, emotional distress, death, disability, disfigurement, or physical or mental illness to any person or thing; (3) violates, or encourages any conduct that violates laws or regulations; (4) contains any information or content we deem to be hateful, violent, harmful, abusive, racially or ethnically offensive, defamatory, infringing, invasive of personal privacy or publicity rights, harassing, humiliating to other people (publicly or otherwise), libelous, threatening, profane, or otherwise objectionable; (5) contains any information or content that is illegal; and/or (6) is fraudulent, false, misleading, or deceptive.<br>
				B.	Tagboard reserves the right, but not the obligation, to remove any content for any reason or for no reason, including content that Tagboard believes violates this TOS. Tagboard may also permanently or temporarily terminate or suspend any user without notice and liability for any reason, including if, in Tagboard’s sole determination, a user violates any provision of this TOS, or for no reason.<br>
				C.	Following termination or deactivation of your use, your account and/or your Tagboard Page, we may retain your content and/or your Tagboard Page for a reasonable period of time for functionality, backup, archival, or audit purposes. Furthermore, Tagboard and its users may retain and continue to use, store, display, reproduce, collect, tabulate, modify, create derivative works, perform, and distribute any of your content that other users have stored, cached or shared through Tagboard.<br>
				</p>
				<h3>VI.	Creating a Tagboard Page.</h3>
				<p>A.	Tagboard provides you with the option of creating a “Tagboard Page”. When you create a Tagboard Page you must provide us with accurate and complete information. If you create a Tagboard Page on behalf of a company, school, organization, group or other entity, then (1) "you" includes you and that entity, and (2) you represent and warrant that you are authorized to grant all permissions and licenses provided in these TOS and bind the entity to these TOS, and that you agree to these TOS on the entity's behalf.  <br>
				B.	Tagboard will terminate a user's access to Tagboard and/or a user’s Tagboard Page if, under appropriate circumstances, the user is determined to violate any of these TOS. No warnings are required and no basis need be provided.<br>
				C.	Tagboard reserves the exclusive right to decide whether content and use violates these TOS for reasons such as, but not limited to, direct and/or indirect copyright infringement, pornography, obscenity, or similar. Tagboard may at any time, without prior notice and in its sole discretion, remove such content and/or terminate a user's Tagboard Page and/or future content submissions for submitting and/or maintaining such material in violation of these TOS.<br>
				D.	A Tagboard Page may include one or more assignable hashtags.  These assignable hashtags shall be assigned, withdrawn, transferred, deleted, reassigned, canceled, suspended and/or retired at the sole and binding discretion of Tagboard.  
				</p>
				<h3>VII.	Impermissible Use.</h3>
				<p>It is a breach of these TOS to:<br>
				A.	Send any unsolicited or unauthorized spam, advertising messages, promotional materials, email, junk mail, chain letters or other form of solicitation on Tagboard.<br>
				B.	Use, display or mirror Tagboard, any individual element within Tagboard, the Tagboard name, trademark, logo or other proprietary information, or the layout and design of any page, without our express written consent.<br>
				C.	Access, tamper with, or use non-public areas of Tagboard, our computer systems and servers, or the technical delivery systems of our providers;<br>
				D.	Probe, scan, or test the vulnerability of Tagboard, our computer systems and servers and network or breach any security or authentication measures.<br>
				E.	Avoid, bypass, remove, deactivate, impair, descramble or otherwise circumvent any technological measure implemented by Tagboard or any of our providers or any other third party (including another user) to protect Tagboard or Tagboard Content.<br>
				F.	Attempt to access or search Tagboard beyond its public functionality, or Tagboard Content or scrape or download Tagboard, Tagboard Pages, or Tagboard Content, or otherwise use, upload content to, or create new links, reposts, or referrals in Tagboard through the use of any engine, software, tool, agent, device or mechanism, including automated scripts, spiders, data mining tools or similar, other than the software provided by Tagboard or other generally available third-party web browsers.<br>
				G.	Use Tagboard for any commercial purpose or the benefit of any third party, except as otherwise explicitly permitted for you by Tagboard or in any manner not permitted by the TOS.<br>
				H.	Attempt to decipher, decompile, disassemble or reverse engineer Tagboard.<br>
				I.	Interfere with, or attempt to interfere with, the access of any user, host or network, including, without limitation, sending a virus, overloading, flooding, spamming, or mail-bombing Tagboard.<br>
				J.	Collect or store any personally identifiable information from Tagboard without express permission.<br>
				K. 	Use Tagboard as a tool to impersonate a person, company, group or other entity. <br>
				</p>
				<h3>VIII.	Copyright Policy.</h3>
				<p>Tagboard has adopted a policy consistent with the Digital Millennium Copyright Act. 
				</p>
				<h3>IX.	Privacy Policy.</h3>
				<p>A.	Basic use of Tagboard does not require a user to provide any private information. As on many web sites, Tagboard may automatically receive general information that is contained in server log files, such as your IP address, and cookie information. Information about how advertising may be served on Tagboard (if it is indeed Tagboard's policy to display advertising) is set forth below.<br>
				B.	Data may be used to customize and improve your user experience on Tagboard. Efforts will be made to prevent your data being made available to third-parties unless (1) provided for otherwise in this Privacy Policy; (2) your consent is obtained, such as when you choose to opt-in or opt-out for the sharing of data; (3) a service provided on Tagboard requiring interaction with a third party, or is provided by a third party, such as an application service provider; (4) pursuant to legal action or law enforcement; (5) it is found that your use of Tagboard violates the TOS, or if it is deemed reasonably necessary by Tagboard to protect legal rights and/or property; or (6) this site is purchased by a third party. In the event you choose to use links displayed on Tagboard to visit third-party web sites, you are advised to read the privacy policies published on those sites.<br>
				C.	Tagboard may set and use cookies to enhance your user experience. Advertisements may display on Tagboard and, if so, may set and access cookies on your computer. Such cookies are subject to the privacy policy of the parties providing the advertisement. Tagboard reserves the right to grant access to these cookies by third parties.<br> 
				D.	Changes may be made to this policy from time to time. While this privacy policy states standards for maintenance of data, and while efforts will be made to meet the said standards, Tagboard is not in a position to guarantee compliance with these standards. There may be factors beyond Tagboard’s control that may result in disclosure of data. Consequently, Tagboard offers no warranties or representations as regards maintenance or non-disclosure of data.<br>
				</p>
				<h3>X.	Security.</h3>
				<p>Tagboard efforts to protect the security of the website and Tagboard Content.  However, Tagboard cannot guarantee that unauthorized third parties will not be able to circumvent and/or compromise our security. Please notify us immediately of any compromise or unauthorized use of Tagboard or your Custom Tagboard.
				</p>
				<h3>XI.	Contacting Tagboard.</h3>
				<p>We value feedback and comments from Tagboard users. If you submit comments, ideas or feedback, you agree that we are free to use them without any restriction or compensation to you. Tagboard maintains all rights to use your feedback and/or similar or related feedback previously known to Tagboard, or developed by its employees, or obtained from sources other than you.
				</p>
				<h3>XII.	Indemnity</h3>
				<p>If your use of Tagboard violates this TOS, as determined in our sole and absolute discretion, you agree to indemnify and hold harmless Tagboard and its officers, directors, employees and agents, from and against any claims, suits, proceedings, disputes, demands, liabilities, damages, losses, costs and expenses, including, without limitation, reasonable legal and accounting fees (including costs of defense of claims, suits or proceedings brought by third parties), in any way related to (a) your access to or use of Tagboard, (b) your content, or (c) your breach of any of these TOS.
				</p>
				<h3>XIII. Termination.</h3>
				<p>Tagboard may terminate or suspend this license at any time, with our without cause or notice to you. 
				</p>
				<h3>XIV.	Limitation of Liability and Disclaimers.</h3> 
				<p>IN NO EVENT SHALL TAGBOARD, ITS OFFICERS, DIRECTORS, EMPLOYEES, OR AGENTS, BE LIABLE TO YOU FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, PUNITIVE, OR CONSEQUENTIAL DAMAGES WHATSOEVER RESULTING FROM ANY: (a) ERRORS, MISTAKES, OR INACCURACIES OF TAGBOARD CONTENT; (b) PERSONAL INJURY OR PROPERTY DAMAGE, OF ANY NATURE WHATSOEVER, RESULTING FROM YOUR ACCESS TO AND USE OF TAGBOARD; (c) ANY UNAUTHORIZED ACCESS TO OR USE OF OUR SECURE SERVERS AND/OR ANY AND ALL PERSONAL INFORMATION AND/OR FINANCIAL INFORMATION STORED THEREIN; (d) ANY INTERRUPTION OR CESSATION OF TRANSMISSION TO OR FROM TAGBOARD; (e) ANY BUGS, VIRUSES, TROJAN HORSES, OR THE LIKE, WHICH MAY BE TRANSMITTED TO OR THROUGH TAGBOARD BY ANY THIRD PARTY; AND/OR (f) ANY ERRORS OR OMISSIONS IN ANY CONTENT OR FOR ANY LOSS OR DAMAGE OF ANY KIND INCURRED AS A RESULT OF YOUR USE OF ANY CONTENT POSTED, EMAILED, TRANSMITTED, OR OTHERWISE MADE AVAILABLE VIA TAGBOARD, WHETHER BASED ON WARRANTY, CONTRACT, TORT, OR ANY OTHER LEGAL THEORY, AND WHETHER OR NOT TAGBOARD IS ADVISED OF THE POSSIBILITY OF SUCH DAMAGES. THE FOREGOING LIMITATION OF LIABILITY SHALL APPLY TO THE FULLEST EXTENT PERMITTED BY LAW IN THE APPLICABLE JURISDICTION.<br>
				YOU SPECIFICALLY ACKNOWLEDGE THAT TAGBOARD SHALL NOT BE LIABLE FOR CONTENT OR THE DEFAMATORY, OFFENSIVE, OR ILLEGAL CONDUCT OF ANY THIRD PARTY AND THAT THE RISK OF HARM OR DAMAGE FROM THE FOREGOING RESTS ENTIRELY WITH YOU.

				</p><p>The Products and all included content are provided on an "as is" basis without warranty of any kind, whether express or implied.
				</p>
				<p>TAGBOARD SPECIFICALLY DISCLAIMS ANY AND ALL WARRANTIES AND CONDITIONS OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, AND NON-INFRINGEMENT, AND ANY WARRANTIES ARISING OUT OF COURSE OF DEALING OR USAGE OF TRADE.
				</p>
				<p>Tagboard takes no responsibility and assumes no liability for any Tagboard Content or any content that you or any other user or third-party posts or transmits using Tagboard. You understand and agree that you may be exposed to Tagboard Content that is incorrect, objectionable, inappropriate, or otherwise unsuited to your purpose.
				</p>
				<h3>XV.	Arbitration and Jurisdiction.</h3>
				<p>A.	For any dispute you have with Tagboard, you agree to first contact us and attempt to resolve the dispute with us informally. If Tagboard has not been able to resolve the dispute with you informally, we each agree to resolve any claim, dispute, or controversy (excluding claims for injunctive or other equitable relief) arising out of or in connection with or relating to these Terms by binding arbitration by the American Arbitration Association ("AAA") under the Commercial Arbitration Rules then in effect, except as provided herein. <br>
				B.	Should arbitration prove unsuccessful, you agree that: (1) Tagboard shall be deemed solely based in Washington; and (2) Tagboard shall be deemed a passive website that does not give rise to personal jurisdiction over Tagboard, either specific or general, in jurisdictions other than Washington. These TOS shall be governed by the laws of the State of Washington. Any claim or dispute between you and Tagboard that arises in whole or in part from Tagboard shall be decided exclusively by a court of competent jurisdiction located in Washington. These TOS and any other legal notices published by Tagboard, shall constitute the entire agreement between you and Tagboard. If any provision of these TOS is deemed invalid by a court of competent jurisdiction, the invalidity of such provision shall not affect the validity of the remaining provisions of these TOS, which shall remain in full force and effect. Tagboard reserves the right to amend these TOS at any time and without notice, and it is your responsibility to review these TOS for any changes. Your use of Tagboard following any change of these TOS will signify your assent to and acceptance of its revised terms. 
				</p>
			</div>

	</div>
</div>


@if(Auth::check())
   @include('user.user-dropdown')
@endif





@stop