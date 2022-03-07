
<?php
/**
 * Element to display the room grid using html and javascript
 */
?>

    <div id="room-buttons">
        <?php 
        /*
            foreach($rooms as $room){
            // echo '<div class="col-md-2">';
            // echo '<button type="button" id="room_'.$room['room_number'].'" class="btn btn-block btn-default" onClick="addRoom(this, '.$room['room_number'].','.$room['room_type']['rate'].');">'.$room['room_number'].'</button>';
            // echo '</div>';
            }
        */
        ?>
    </div>
    <script>                
        //fetch('http://localhost:3000/rooms')
        fetch('http://ec2-3-145-118-240.us-east-2.compute.amazonaws.com:3000/rooms')
            .then(response => response.json())
            .then(rooms => {                      
            rooms.forEach(room => {
                renderButtons(room);                
            });
        });

        function renderButtons(room){
            //console.log(room);
            // var room = objectToMap(d);

            var buttonDiv = document.getElementById('room-buttons');
            var color = '';
            switch (room.status) {
            case 'vacant':
                color = "success";
                break;
            case 'occpupied':
                color = "danger";
                break;
            default:
                color = "default";
            }
            //var color = 'success';
            buttonDiv.innerHTML+= '<div class="col-md-2">'
                +'<button type="button" class="btn btn-block btn-'+ color +'" '
                +'id="room_'+room.room_number+'" onClick="processRoomButtonClick(this, \''+room.room_type._id+'\', \''+room.room_type.name+'\', '+room.room_type.rate+', \''+room.room_number+'\', \''+room._id+'\');">'
                + room.room_number+'</button></div>';
        }

        const objectToMap = obj => {
            const keys = Object.keys(obj);
            const map = new Map();
            for(let i = 0; i < keys.length; i++){
                //inserting new key value pair inside map
                map.set(keys[i], obj[keys[i]]);
            };
            return map;
        };                

    </script>    