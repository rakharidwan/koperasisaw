
  console.log($(this).data('token'));
$('#td').on('click','#detail-anggota',function(){
  $.ajax({
    url: '/anggota/verifikasi_akun/rincian/{token}',
    type: 'GET',
    data: { id : $(this).data('token') },
    success: function(anggota)
    {
      $('.modal-body').html(anggota);
      }
});
});