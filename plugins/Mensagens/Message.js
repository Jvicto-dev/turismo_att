function Message(mensagem, tipo){
    
      Swal.fire(
              mensagem,
              '',
              tipo
            )

}


    
function DeletarDestino(id){

      Swal.fire({
        title: 'Tem certeza disso ?',
        text: "Você não poderá reverter isso!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, Deletar isso!'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href="../../Actions/actionDestinos.php?deletIdDestino="+id    
        }
      })
}

function DeletarVeiculo(id){

  Swal.fire({
    title: 'Tem certeza disso ?',
    text: "Você não poderá reverter isso!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sim, Deletar isso!'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href="../../Actions/actionVeiculos.php?deletIdVeiculo="+id    
    }
  })
}

function DeletarPassagem(id){
  Swal.fire({
    title: 'Tem certeza disso ?',
    text: "Você não poderá reverter isso!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sim, Deletar isso!'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href="../../Actions/actionPassagem.php?deletIdPassagem="+id    
    }
  })
}

function DeletarUsuario(id){
  Swal.fire({
    title: 'Tem certeza disso ?',
    text: "Você não poderá reverter isso!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sim, Deletar isso!'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href="../../Actions/actionUsuario.php?deletIdUsuario="+id    
    }
  })
}

function DeletarHotel(id){
  Swal.fire({
    title: 'Tem certeza disso ?',
    text: "Você não poderá reverter isso!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sim, Deletar isso!'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href="../../Actions/actionHotel.php?deletIdHotel="+id    
    }
  })
}




function estadoLoja(id,estado){
  Swal.fire({
    title: 'Tem certeza disso ?',
    text: "Esta ciente dessa Ação ?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sim, faça isso!'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href="../../Actions/ActionLojas.php?estadoLoja="+id+"&estado="+estado    
    }
  })
}

ReativarLoja