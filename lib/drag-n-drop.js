const dragStart = target => {
    target.classList.add('dragging');
};

const dragEnd = target => {
    target.classList.remove('dragging');    
};

const dragEnter = event => {
    event.currentTarget.classList.add('drop');    
};

const dragLeave = event => {
    event.currentTarget.classList.remove('drop');
};

const drag = event => {
    event.dataTransfer.setData('text/html', event.currentTarget.outerHTML);
    event.dataTransfer.setData('text/plain', event.currentTarget.dataset.id);
    
};

const drop = event => {
    document.querySelectorAll('.column').forEach(column => column.classList.remove('drop'));
    document.querySelector(`[data-id="${event.dataTransfer.getData('text/plain')}"]`).remove();

    event.preventDefault();
    event.currentTarget.innerHTML = event.currentTarget.innerHTML + event.dataTransfer.getData('text/html');

    var id_lista = event.currentTarget.getAttribute('id');
    var id_cartao = event.dataTransfer.getData('text')

    console.log(id_lista) //Id do meu quadro
    console.log(id_cartao) //id do meu cartao
    
    alterar_posicao(id_lista,id_cartao)

};

const allowDrop = event => {
    event.preventDefault();
};

document.querySelectorAll('.column').forEach(column => {
    column.addEventListener('dragenter', dragEnter);
    column.addEventListener('dragleave', dragLeave);
});

document.addEventListener('dragstart', e => {
    if (e.target.className.includes('card')) {
        dragStart(e.target);
    }
});

document.addEventListener('dragend', e => {
    if (e.target.className.includes('card')) {
        dragEnd(e.target);
    }
});

function  alterar_posicao(id_lista,id_cartao){
  var fd = new FormData()
  fd.append('acao','alterar_cartao_pos')
  fd.append('id_lista',id_lista)
  fd.append('id_cartao',id_cartao)
  var Ajax = new XMLHttpRequest()
  Ajax.open('POST','../api/quadros.php',true)
  Ajax.onreadystatechange = function(){
    if(Ajax.readyState == 4){
      if(Ajax.status == 200){
          resposta = Ajax.responseText
          console.log(resposta)
      }
    }
  }
  Ajax.send(fd);
}