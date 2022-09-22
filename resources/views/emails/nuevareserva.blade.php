<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>A Simple Responsive HTML Email</title>
        <style type="text/css">
        body {margin: 0; padding: 0; min-width: 100%!important;}
        .content {width: 100%; max-width: 600px;}

        table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    text-align: left;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}
        </style>
    </head>
    <body yahoo bgcolor="#f6f8f1">
        <table width="100%" bgcolor="#f6f8f1" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td>
                    <table class="content" align="center" cellpadding="0" cellspacing="0" border="0">
                    </table>
                    <div style="overflow-x:auto;">
                    <table border="1">
                        <tr>
                            <th class="header" bgcolor="#0A72B5" style="height: 60px;text-align: center;" colspan="2">
                                <font style="color: white; font-size: x-large;" >Nueva Reserva</font>
                            </th>
                        </tr>
                        <tr>
                            <td colspan="2"><p>Se genero un nueva reserva creada por: <strong>{{ $reserva->solicitante->name }}</strong> </p></td>
                        </tr>
                        <tr>
                            <td><p><strong>N° Reserva</strong></p></td>
                            <td><p>{{$reserva->id}}</p></td>
                        </tr>
                        <tr>
                            <td><p><strong>Nombre</strong></p></td>
                            <td><p>{{$reserva->nom_act}}</p></td>
                        </tr>
                        <tr>
                            <td><p><strong>Sede</strong></p></td>
                            <td><p>{{$reserva->sede->nombre}}</p></td>
                        </tr>
                        <tr>
                            <td><p><strong>Sala o Dependencia</strong></p></td>
                            <td><p>{{$reserva->sector->nombre}}</p></td>
                        </tr>
                    </table>
                    <div>
                </td>
            </tr>
        </table>
        <div>
            <h2>Para Ingresar a la Solicitud Presione <a href="{{url('reservar/ver').'/'.$reserva->id }}">'Aqui'</a> </h2>
        </div>
    </body>
</html>