@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-4">

        <h1 class="mb-4"></h1>
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title mb-0">📅 ปฏิทินกิจกรรม</h3>
            </div>
            <div class="card-body">
                <div id="calendar" style="max-width: 1500px; margin: auto;"></div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'th',
                timeZone: 'local',
                events: '/car-requests/calendar-events',

                eventContent: function(arg) {
                    const event = arg.event.extendedProps;
                    const bgColor = arg.event.backgroundColor || '#3788d8'; // fallback สี

                    return {
                        html: `
                        <div style="
                            font-size: 0.75rem; 
                            line-height: 1.2; 
                            background-color: ${bgColor}; 
                            color: #fff; 
                            padding: 2px 4px; 
                            border-radius: 3px;
                        ">
                            <b>สถานที่: ${arg.event.title}</b><br>
                            ผู้ขอ: ${event.requester}<br>
                            กลุ่ม: ${event.department}<br>
                            เวลา: ${event.start_time} - ${event.end_time}<br>
                            ทะเบียนรถ: ${event.car_registration ?? '-'}
                        </div>
                    `
                    };
                },

                eventDidMount: function(info) {
                    console.log('Event:', info.event.title, 'BG Color:', info.el.style.backgroundColor);
                },

                eventClick: function(info) {
                    
                    const props = info.event.extendedProps;
                    
                    document.getElementById('modal-destination').textContent = info.event.title;
                    document.getElementById('modal-requester').textContent = props.requester;
                    document.getElementById('modal-department').textContent = props.department;
                    document.getElementById('modal-time').textContent =
                        `${props.start_time} - ${props.end_time}`;
                    document.getElementById('modal-plate').textContent = props.car_registration;
                    document.getElementById('modal-driver').textContent = props.driver ?? '-';
                    
                    document.getElementById('modal-purpose').textContent = props.purpose ?? '-';
                    document.getElementById('modal-meeting_datetime').textContent = props
                        .meeting_datetime ?? '-';
                    document.getElementById('modal-province').textContent = props.province ?? '-';
                    document.getElementById('modal-car_name').textContent = props.car_name ?? '-';
                    document.getElementById('modal-driver_phone').textContent = props.driver_phone ?? '-';
                    
                    document.getElementById('modal-car_request_time').textContent = props
                        .request_time ?? '-';


                    const modal = new bootstrap.Modal(document.getElementById('eventDetailModal'));
                    modal.show();
                    
                },


                dateClick: function(info) {
                    fetch('/car-requests/set-date', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            date: info.dateStr
                        })
                    }).then(() => {
                        window.location.href = '/car-requests/create';
                    });
                }

            });

            calendar.render();
        });
    </script>

    <!-- Modal -->
    <div class="modal fade" id="eventDetailModal" tabindex="-1" aria-labelledby="eventDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="eventDetailModalLabel">รายละเอียด</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>สถานที่:</strong> <span id="modal-destination"></span></p>
                    <p><strong>เพื่อ(ไปทำอะไร):</strong> <span id="modal-purpose"></span></p>
                    <p><strong>เวลาที่ประชุม:</strong> <span id="modal-meeting_datetime"></span></p>
                    <p><strong>จังหวัด:</strong> <span id="modal-province"></span></p>
                    <p><strong>ผู้ขอ:</strong> <span id="modal-requester"></span></p>
                    <p><strong>กลุ่ม:</strong> <span id="modal-department"></span></p>
                    <p><strong>เวลาไป/กลับ:</strong> <span id="modal-time"></span></p>
                    <p><strong>ทะเบียนรถ:</strong> <span id="modal-plate"></span></p>
                    <p><strong>รถ:</strong> <span id="modal-car_name"></span></p>
                    <p><strong>คนขับ:</strong> <span id="modal-driver"></span></p>
                    <p><strong>เบอร์คนขับ:</strong> <span id="modal-driver_phone"></span></p>
                    <p><strong>เวลาที่ขอรถ:</strong> <span id="modal-car_request_time"></span></p>
                    <!--<p><strong>สถานะ:</strong> <span id="modal-status"></span></p>-->
                </div>
            </div>
        </div>
    </div>
@endpush
