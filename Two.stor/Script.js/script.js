 
  const sliders = document.querySelectorAll('.image-slider');

  sliders.forEach((slider) => {
    const images = slider.querySelectorAll('img');
    const btnLeft = slider.querySelector('.slider-btn.left');
    const btnRight = slider.querySelector('.slider-btn.right');

    let currentImg = 0;
    const totalImg = images.length;
    
 
    if (totalImg === 1) {
      slider.classList.add('single-image');
    }
    
    function showImage(index) {
      images.forEach((img, i) => {
        img.classList.toggle('active', i === index);
      });
      currentImg = index;
    }
    

    btnLeft.addEventListener('click', () => {
      let newIndex = currentImg - 1;
      if (newIndex < 0) newIndex = totalImg - 1;
      showImage(newIndex);
    });

  
    btnRight.addEventListener('click', () => {
      let newIndex = currentImg + 1;
      if (newIndex >= totalImg) newIndex = 0;
      showImage(newIndex);
    });


    if (slider.dataset.autoslide === 'true' && totalImg > 1) {
      setInterval(() => {
        let newIndex = currentImg + 1;
        if (newIndex >= totalImg) newIndex = 0;
        showImage(newIndex);
      }, 3000);
    }
  });

