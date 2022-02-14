<style>
    blockquote {
        border-left: 7px solid #2bc4ee;
        padding-left: 20;
    }
</style>
<div id=":ru" class="a3s aXjCH m162811f50c84aefd"><u></u>
    <div style="margin:0px;padding:0px" bgcolor="#d8d6d6">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#d8d6d6">
            <tbody>
                <tr>
                    <td height="60" align="center" valign="middle" style="font-family:'Open Sans',Arial,sans-serif;font-size:13px;line-height:20px;color:#313538">
                        {{--Watch the quick video to set up your first SMS integration.--}}
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="top">
                        <table width="600" cellpadding="0" cellspacing="0" border="0" bgcolor="#FFFFFF" align="center" class="m_-2010080597923446268em_main_table" style="table-layout:fixed">
                            <tbody>
                                <tr>
                                    <td align="center">
                                        <table width="88%" border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse">
                                            <tbody>
                                                <tr>
                                                    <td height="35" style="height:35px">&nbsp;</td>
                                                </tr>
                                                {{--  @if(isset($generalSetting->logo))
                                                  <tr>
                                                        <td align="center">
                                                            <img src="{{ asset('images'.DIRECTORY_SEPARATOR.'setting'.DIRECTORY_SEPARATOR.'general'.DIRECTORY_SEPARATOR.$generalSetting->logo) }}" width="216" style="display:block;font-family:Arial,sans-serif;font-size:18px;line-height:25px;font-weight:bold;color:#163a66;text-align:center;max-width:216px;width:100px;border-radius: 50%;" border="0" alt="{{ $data['subject'] }}" class="CToWUd">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td height="30" style="height:30px">&nbsp;</td>
                                                    </tr>
                                                @endif--}}
                                                <tr>
                                                    <td align="center" class="m_-2010080597923446268copy-main" style="font-family:'Open Sans',Arial,sans-serif;font-size:27px;line-height:31px;color:#313538; border-bottom:5px #2bc4ee solid; padding-bottom: 10px; ">
                                                        <span>
                                                            {{$data['subject']}}
                                                        </span>
                                                        {{--<hr style="background: #2bc4ee;">--}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="30" style="height:30px">&nbsp;</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                {{--<tr>
                                    <td align="center" valign="top" bgcolor="#2bc4ee" style="border-bottom:3px solid #2bc4ee">
                                        <a id="m_-2010080597923446268ct0_1" href="#" target="_blank"><img src="" width="600" style="display:block;font-family:Arial,sans-serif;font-size:18px;line-height:25px;font-weight:bold;color:#163a66;text-align:center;max-width:600px;width:100%" border="0" alt="" class="CToWUd"></a>
                                    </td>
                                </tr>--}}
                                <tr>
                                    <td align="center">
                                        <table width="88%" border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse">
                                            <tbody>
                                                {{--<tr>
                                                    <td height="35" style="height:35px">&nbsp;</td>
                                                </tr>--}}
                                                <tr>
                                                    <td class="m_-2010080597923446268copy-main" style="font-family:'Open Sans',Arial,sans-serif;font-size:14px;line-height:21px;color:#313538">
                                                        {!! $data['message'] !!}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="30" style="height:30px">&nbsp;</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                @if($generalSetting->website)
                                <tr>
                                    <td height="70" align="center" valign="middle" bgcolor="#ebebeb">
                                        <table width="150" border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse">
                                            <tbody>
                                                <tr>
                                                    <td height="40" align="center" valign="middle" bgcolor="#2bc4ee" style="border-radius:20px">
                                                        <a style="font-family:Arial,Helvetica,sans-serif;font-size:14px;color:#ffffff;text-decoration:none;font-weight:bold" href="{{$generalSetting->website}}">Visit Now</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <td align="center">
                                        <table width="88%" border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse">
                                            <tbody>
                                                <tr>
                                                    <td height="30" style="height:30px">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td style="font-family:'Open Sans',Arial,sans-serif;font-size:14px;line-height:26px;color:#313538"> Chat soon!<br>
                                                        <span style="color:#2bc4ee;font-weight:bold;font-size:18px;line-height:25px">{{ $generalSetting->institute }}</span>
                                                        <br>
                                                        @if($generalSetting->address)
                                                            {{$generalSetting->address}}
                                                        @endif
                                                        @if($generalSetting->phone)
                                                            <span style="color:#2bc4ee">•</span>
                                                                {{ $generalSetting->phone }}
                                                        @endif

                                                        <br>
                                                        @if($generalSetting->email)
                                                            <a style="color:#313538;text-decoration:none" href="mailto:{{ $generalSetting->email }}" target="_blank">{{$generalSetting->email}}</a>
                                                        @endif
                                                        @if($generalSetting->website)
                                                            <span style="color:#2bc4ee">•</span>
                                                            <a style="color:#313538;text-decoration:none" id="m_-2010080597923446268ct2_0" href="{{$generalSetting->website}}" target="_blank" data-saferedirecturl="#">
                                                                {{ $generalSetting->website }}
                                                            </a>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="10" style="height:10px">&nbsp;</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="30" style="height:30px">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td height="45" align="center" bgcolor="#2bc4ee" class="m_-2010080597923446268bg-gradient-image" style="background:url({{ asset('assets/images/email/link_back.gif') }}) no-repeat right;background-color:#2bc4ee">
                                        <table width="85%" border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse;font-family:'Open Sans',Arial,sans-serif;font-size:11px;color:#ffffff">
                                            <tbody>
                                                <tr>
                                                    <td width="52%" align="right" valign="middle" class="m_-2010080597923446268stack-column-center">Stay connected our community</td>
                                                    <td width="3%" class="m_-2010080597923446268stack-column-center" style="min-height:5px"></td>
                                                    <td width="45%" align="left" valign="middle" class="m_-2010080597923446268stack-column-center">
                                                        <table border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse" class="m_-2010080597923446268mobile-center">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="32"><a style="text-decoration:none" href="{{ $generalSetting->facebook?$generalSetting->facebook:"#" }}" target="_blank"><img src="{{ asset('assets/images/email/social-facebook.gif') }}" width="32" height="31" style="display:block;font-family:Arial,sans-serif;font-size:9px;color:#ffffff" border="0" alt="Facebook" class="CToWUd"></a></td>
                                                                    <td width="32"><a href="{{$generalSetting->twitter?$generalSetting->twitter:"#"}}" target="_blank"><img src="{{ asset('assets/images/email/social-twitter.gif') }}" width="32" height="31" style="display:block;font-family:Arial,sans-serif;font-size:9px;color:#ffffff" border="0" alt="Twitter" class="CToWUd"></a></td>
                                                                    <td width="32"><a href="{{$generalSetting->youtube?$generalSetting->youtube:"#"}}" target="_blank"><img src="{{ asset('assets/images/email/social-youtube.gif') }}" width="32" height="31" style="display:block;font-family:Arial,sans-serif;font-size:9px;color:#ffffff" border="0" alt="YouTube" class="CToWUd"></a></td>
                                                                    <td width="32"><a href="{{$generalSetting->linkedIn?$generalSetting->linkedIn:"#"}}" target="_blank"><img src="{{ asset('assets/images/email/social-linkedin.gif') }}" width="32" height="31" style="display:block;font-family:Arial,sans-serif;font-size:9px;color:#ffffff" border="0" alt="Linkedin" class="CToWUd"></a></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td align="center">
                                        <table width="85%" border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse">
                                            <tbody>
                                                <tr>
                                                    <td height="35" style="height:35px">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td align="center" style="font-family:'Open Sans',Arial,sans-serif;font-size:12px;line-height:18px;color:#313538">
                                                        <a style="text-decoration:none;color:#313538"  href="#" target="_blank" data-saferedirecturl="#">Terms</a>
                                                        &nbsp;&nbsp;|&nbsp;&nbsp;
                                                        <a style="text-decoration:none;color:#313538"  href="#" target="_blank" data-saferedirecturl="#">Privacy</a>
                                                        &nbsp;&nbsp;|&nbsp;&nbsp;
                                                        <a style="text-decoration:none;color:#313538" href="#" target="_blank" data-saferedirecturl="#">Unsubscribe</a>
                                                        @if($generalSetting->institute)
                                                        <hr>
                                                        © {{ $generalSetting->institute }} All rights reserved.
                                                        <hr>
                                                            @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="25" style="height:25px">&nbsp;</td>
                                                </tr>
                                                @if($generalSetting->logo)
                                                    <tr>
                                                        <td align="center" valign="middle">
                                                            <img src="{{ asset('images'.DIRECTORY_SEPARATOR.'setting'.DIRECTORY_SEPARATOR.'general'.DIRECTORY_SEPARATOR.$generalSetting->logo) }}" width="216" style="display:block;font-family:Arial,sans-serif;font-size:18px;line-height:25px;font-weight:bold;color:#163a66;text-align:center;max-width:216px;width:100%;" border="0" alt="{{ $generalSetting->institute }}" class="CToWUd">
                                                        </td>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    <td height="35" style="height:35px">&nbsp;</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div></div>