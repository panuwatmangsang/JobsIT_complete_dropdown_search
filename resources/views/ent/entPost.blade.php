<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"> </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxhptRBEoHuFAstfD_crQDRYtufCVneJA&callback=initMap&libraries=&v=weekly" async></script>
    <script src="/jobs_it/js/post.js"> </script>
  
    <title>Post</title>
    <style>
        #map {
            height: 50%;
            width: 73%;
            position: absolute;

        }

        /* Optional: Makes the sample page fill the window. */
        html,
        body {
            height: 10px;
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>



    <div class="container" style="margin-top: 20px;">
        <form method="POST" action="{{route('Entpost')}}">
            {{csrf_field()}}
            <div class="form-group">
                <label>ชื่อบริษัท:</label>
                <input type="text" name="nameCompany" class="form-control" placeholder="Name" />
            </div>

            <div class="form-group">
                <label>ที่อยู่:</label>
                <textarea type="text" name="address" class="form-control" rows="8" placeholder="Type address..."></textarea>
                <input type="hidden" name="lat" id="loc_lat" />
                <input type="hidden" name="lng" id="loc_long" />
            </div>

            <div class="form-group">
                <label for="exampleFormControlSelect1">ประเภทของงาน</label>
                <select class="form-control" name="JopType" id="exampleFormControlSelect1">
                    <option value="fulltime">Fulltime</option>
                    <option value="pasttime">Pasttime</option>
                </select>
            </div>

            <div class="form-group">
                <label for="exampleFormControlSelect1">ประเภทการทำงาน</label>
                <select class="form-control" name="locaWork" id="exampleFormControlSelect1">
                    <option value="WFH">Work From Home</option>
                    <option value="Company">At Company</option>
                </select>
            </div>

            <br>
            <p>กดเพื่อบันทึกพิกัดที่ตั้งบริษัท</p>
            <div id="map"></div>
            <button type="submit" class="btn btn-primary" style="width: 10%;margin-top:410px">ส่ง</button>
        </form>

    </div>
</body>

</html>