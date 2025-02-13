const sr = ScrollReveal({
    origin: 'top',
    distance: '80px',
    duration: 2500,
    delay: 100,
    viewFactor: 0.2,
});

// origin : top
sr.reveal(`nav, .top__files , .text__work ,.text__client ,.top__footer`);


// origin : left 
sr.reveal(`.logo__hero, .text__hero, .img__about, .partial__about, .text__service, .partial__files, .left__files , .left_partners , .left__work ,.text__footer `, { origin: 'left' });
sr.reveal(`.service__box`, { interval: 200,origin: 'left' }); // عدة عناصر والانتظار بينهم

// origin : right
sr.reveal(`.right__hero, .img__hero, .text__about, .img__service , .right_partners , .right__work`, { origin: 'right' });

// origin : bottom
sr.reveal(`.center__partners , .review__arrow`, { origin: 'bottom' });
sr.reveal(`.links__footer`, { interval: 100,origin: 'bottom' }); // عدة عناصر والانتظار بينهم
sr.reveal(`.card__about, .card__file , .img__partners , .top__work`, { interval: 200,origin: 'bottom' }); // عدة عناصر والانتظار بينهم
