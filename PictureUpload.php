<?php

/*  ====================================================================
*  Copyright (c) 2000 Astonish Inc.
*  www.blazonry.com/scripting/upload-size.php
*  All rights reserved.
*
*  Redistribution and use in source and binary forms, with or without
*  modification, are permitted provided that the following conditions
*  are met:
*
*  1. Redistributions of source code must retain the above copyright
*     notice, this list of conditions and the following disclaimer.
*
*  2. Redistributions in binary form must reproduce the above copyright
*     notice, this list of conditions and the following disclaimer in the
*     documentation and/or other materials provided with the distribution.
*
*  3. The name of the author may not be used to endorse or promote products
*     derived from this software without specific prior written permission.
*
*  THIS SOFTWARE IS PROVIDED BY THE AUTHOR ``AS IS'' AND ANY EXPRESS OR
*  IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES
*  OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.
*  IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY DIRECT, INDIRECT,
*  INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT
*  NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
*  DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
*  THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
*  (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF
*  THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
*  ====================================================================
*/


/*
    SCRIPT CHANGE LOG:

    2002-06-10:

        * Plugged security hole with is_uploaded_file() function. Thanks much
          to Timothy Rieder for pointing this out.


    2001-01-10:

        * Added line of text letting user know what extension was read in
          when denying a file upload. Suggestion by Sandro Juergensen.


    2001-01-09:

        * Removed GIF support from script to not encourage the use of
          silly patents. For more info: http://www.gnu.org/philosophy/gif.html

        * Cleaned up the code and comments

        * Moved the extension check out of the size check loop.
          Thanks Sandro Juergensen <forgetit@sandlatscher.de>

        * Added lower casing the extension check

        * Added converting spaces in filename to underscores

    2000-05-31:

        * original script released
*/
?>
<html>

<head>
    <title>PHP : Upload and Resize an Image</title>
</head>
<body bgcolor="#cccccc">

    <h2>Upload and Resize an Image</h2>

    <form action="processImage.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="MAX_FILE_SIZE" value="50000">

    <p>Upload Image: <input type="file" name="imgfile"><br>
    <font size="1">Click browse to upload a local file</font><br>
    <br>
    <input type="submit" value="Upload Image">
    </form>

</body>
</html>

