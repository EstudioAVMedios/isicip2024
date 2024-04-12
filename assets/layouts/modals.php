<!--/ MODAL LOGIN /-->
<div class="modal fade" id="login" tabindex="-1" aria-labelledby="exampleModalLogin" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text center p-3">
                <h3 class="modal-title text-center fs-5" id="exampleModalLogin">Personal Area</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    style="background: none; border: none"><i class="icon-window-close color-red"></i></button>
            </div>
            <div class="modal-body">
                <div class="col-12 small-device-space">
                    <div class="bg-white" style="border-radius: 15px; position: relative; ">
                        <p class="text-center" style="font-size: 12px;line-height: 15px">Access the private
                            area, where you will find information about speakers, committees, sponsors,
                            recordings of previous editions and access to STREAMING.</p>
                        <form class="p-4" id="login-form">
                            <div id="login-alert">
                                <?php
                                if ($pass == true) {
                                    echo "<div class='dtr-counter text-center'> <span class='dtr-count-number counting-number color-blue' data-from='1' data-to='8' data-speed='8000'>8</span></div><p class='bg-blue p-3 text-white my-3' style='border-radius:15px'> Your password has been changed successfully. we will restart the page in 8 seconds so you can log in with the new password</p><script>const myTimeout = setTimeout(reload, 8000);function reload(){window.location.href='index.php'}</script>";
                                }
                                ?>
                            </div>
                            <p class="dtr-form-field"> <span class="dtr-form-subtext">Email</span>
                                <input name="email" type="text" class="required text" placeholder="john@example.com">
                            </p>
                            <p class="dtr-form-field"> <span class="dtr-form-subtext">Password</span>
                                <input name="pass" type="password" class="required text" placeholder="******" id="pass">
                            </p>
                            <div class="w-100" style="text-align: right"><a
                                    style="text-align: right; margin-top: -105px!important; margin-left: auto; cursor: pointer;position: relative"
                                    class="btn" id="show">Show</a></div>
                            <p class="text-decoration-underline" style="cursor: pointer; margin-top: -35px"
                                data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">
                                Change password</p>
                            <button class="dtr-btn btn-red w-100 mt-3" type="button" id="send-login"> Access <i
                                    class="icon-arrow-right-circle dtr-ml-10"></i> </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!--/ CHANGE PASSWORD /-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cambiar contraseña</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    style="background: none; border: none"><i class="icon-window-close color-red"></i></button>
            </div>
            <div class="modal-body">
                <form id="change-form">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Email:</label>
                        <input type="text" class="form-control" id="recipient-name" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Nueva contraseña:</label>
                        <input type="password" class="form-control" id="change-pass" name="pass">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Repita nueva contraseña:</label>
                        <input type="password" class="form-control" id="change-pass2">
                    </div>
                    <div id="change-alert"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn bg-red text-white" id="send-change">Cambiar contraseña</button>
            </div>
        </div>
    </div>
</div>
<!--/ MODAL CONFIDECIALIDAD /-->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2"><strong style="text-decoration: underline">Privacy
                        Policy</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    style="background: none; border: none"><i class="icon-window-close color-red"></i></button>
            </div>
            <div class="modal-body">
                <div class="container p-4">
                    <div>
                        <h3 style="background: var(--bg-color);color:white" class="w-100 p-2">Confidentiality and
                            Data Protection</h3>
                        <p>Pursuant to the GDPR, of April 27, 2016, Fundación Código Sepsis informs Users of the
                            existence of an automated file containing personal data, created by, for and under the
                            liability Fundación Código Sepsis for purposes of maintaining and managing relationships
                            with Users and providing information. Upon acceptance of these general terms and
                            conditions, the User will be asked by Fundación Código Sepsis to provide certain data
                            essential for the provision of its services.</p>
                    </div>
                    <div>
                        <h3 style="background: var(--bg-color);color:white" class="w-100 p-2">Registration of files
                            and forms</h3>
                        <p>To access and use certain services provided via the Website, it is compulsory to complete
                            a registration form. Failure to provide the personal details required or to accept this
                            data protection policy will result in the User being unable to subscribe to, register
                            for or participate in any promotion for which personal details are requested.<br>
                            Pursuant to the GDPR, of April 27, 2016, we inform you that the personal data provided
                            as a result of User registration will be incorporated into a file owned by [NOMBRE
                            CLIENTE], with C.I.F num. G98775976 and corporate address at C/ DEL JUSTICIA, 1 ENTLO.
                            PUERTA 13, VALENCIA, 46003, VALENCIA , and that the security measures have been
                            implemented. </p>
                    </div>
                    <div>
                        <h3 style="background: var(--bg-color);color:white" class="w-100 p-2">Accuracy and
                            truthfulness of data provided</h3>
                        <p>The User accepts full liability for the accuracy and truthfulness of the data provided
                            and exonerates Fundación Código Sepsis from any liability in this regard. The User
                            assures and is answerable in any event for the accuracy, currency and authenticity of
                            the personal data provided and undertakes to keep those data properly updated. The User
                            agrees to provide full and correct information on registration/subscription forms.
                            Fundación Código Sepsis provides no assurances as to the truthfulness of any information
                            not drawn up by the Company itself and identified as coming from other sources and,
                            therefore, assumes no liability for any harm that might be caused by the use of such
                            information. Fundación Código Sepsis provided on its Website and to limit or deny access
                            thereto. Fundación Código Sepsis accepts no liability for any damage or harm that Users
                            may suffer as a result of errors, shortcomings or omissions in information provided by
                            Fundación Código Sepsis provided that it comes from sources other than Fundación Código
                            Sepsis.<br>
                            The site (symposiumsepsis22.com) does not use cookies, considering such physical
                            information files hosted in the user's own terminal and serve to facilitate the user's
                            navigation through the portal. In any case, the user has the possibility of configuring
                            the browser in such a way that it prevents the installation of these files. </p>
                    </div>
                    <div>
                        <h3 style="background: var(--bg-color);color:white" class="w-100 p-2">Purposes</h3>
                        <p>The purposes of Fundación Código Sepsis are to maintain and manage relationships with its
                            Users and to provide information.</p>
                    </div>
                    <div>
                        <h3 style="background: var(--bg-color);color:white" class="w-100 p-2">Assignment of data to
                            third parties</h3>
                        <p>Fundación Código Sepsis undertakes not to assign data on Users to third parties.</p>
                    </div>
                    <div>
                        <h3 style="background: var(--bg-color);color:white" class="w-100 p-2">Exercise of rights of
                            access, rectification, cancellation and opposition</h3>
                        <p>You may send any communications and exercise the rights of access, rectification,
                            erasure, restriction, portability and opposition to the email address
                            eventos03@cerotreseventos.es or by regular mail to Fundación Código Sepsis Ref. GDPR, at
                            C/ DEL JUSTICIA, 1 ENTLO. PUERTA 13, VALENCIA, 46003, VALENCIA. In order to exercise
                            these rights, it is necessary for you to verify your identity before Fundación Código
                            Sepsis by sending a photocopy of your Spanish National identity Document or any other
                            legally valid means. However, you may modify or rectify your registration data on the
                            Website itself after you identify yourself with your username and password. </p>
                    </div>
                    <div>
                        <h3 style="background: var(--bg-color);color:white" class="w-100 p-2">Security measures</h3>
                        <p>Fundación Código Sepsis has implemented the standards of security for the protection of
                            personal data required by law and makes every attempt to install such further technical
                            means and measures as may be available to it to prevent loss of, misuse of, manipulation
                            of, unauthorized access to and theft of the personal data provided to Fundación Código
                            Sepsis accepts no liability for any damage or harm that might result from interference,
                            omissions, interruptions, computer viruses, telephone malfunctions or disconnections in
                            the course of the operation of this electronic system for reasons not attributable to
                            Fundación Código Sepsis; or delays or blockages in the use of this electronic system
                            caused by shortcomings or overloads in telephone lines or overloads at data processing
                            centers, on the Internet or in other electronic systems; or for any damage that may be
                            caused by third parties as a result of unlawful interference beyond the control of
                            Fundación Código Sepsis. Notwithstanding the foregoing, Users should be aware that
                            Internet security measures are not infallible. </p>
                    </div>
                    <div>
                        <h3 style="background: var(--bg-color);color:white" class="w-100 p-2">Acceptance and consent
                        </h3>
                        <p>The User declares that he/she has been informed of the terms and conditions governing the
                            protection of personal data and hereby accepts and consents to the automatic processing
                            of such data by Fundación Código Sepsis in the way and for the purposes indicated in
                            this Personal Data Protection Policy. Some services provided via the portal may entail
                            particular terms and conditions with specific provisions in regard to Personal Data
                            protection.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ MODAL LEGAL NOTICE /-->
<div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel3" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel3"><strong style="text-decoration: underline">Legal
                        Notice</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    style="background: none; border: none"><i class="icon-window-close color-red"></i></button>
            </div>
            <div class="modal-body">
                <div class="container p-4">
                    <div>
                        <h3 style="background: var(--bg-color);color:white" class="w-100 p-2">Legal Notice</h3>
                        <p>This legal notice (hereinafter, the “Legal Notice”) regulates the use of the Internet
                            portal service symposiumsepsis22.com (hereinafter, the “Website”) of Fundación Código
                            Sepsis, with corporate address at C/ DEL JUSTICIA, 1 ENTLO. PUERTA 13, VALENCIA, 46003,
                            VALENCIA and C.I.F G98775976</p>
                    </div>
                    <div>
                        <h3 style="background: var(--bg-color);color:white" class="w-100 p-2">Legislation</h3>
                        <p>The relationship between Fundación Código Sepsis and the Users of its remote services on
                            the Website is subject, in general, to the legislation and jurisdiction of Spain. <br>
                            The parties expressly waive any other jurisdictional rights and submit expressly to the
                            rulings of the courts and tribunals of Valencia for the settlement of any dispute that
                            may arise in the construal or enforcement of these terms and conditions. </p>
                    </div>
                    <div>
                        <h3 style="background: var(--bg-color);color:white" class="w-100 p-2">Intellectual and
                            industrial property</h3>
                        <p>Fundación Código Sepsis is the owner of the intellectual property rights of its website’s
                            content, graphic design and codes; therefore, its reproduction, distribution, public
                            communication, transformation or any other activity performed with the webpage’s content
                            is prohibited (even if the sources were mentioned), unless written consent is given by
                            Fundación Código Sepsis. All the commercial names, trademarks and distinctive signs of
                            any kind contained on the Company’s website are the property of its owners and protected
                            by law. </p>
                    </div>
                    <div>
                        <h3 style="background: var(--bg-color);color:white" class="w-100 p-2">Links</h3>
                        <p>The links provided on symposiumsepsis22.com ’s website serve a mere informational purpose
                            and under no circumstance imply any suggestion, invitation or recommendation. </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ MODAL ALERTS /-->
<div class="modal fade" id="alerts" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog mt-5">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Alert </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    style="background: none; border: none"><i class="icon-window-close color-red"></i></button>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>