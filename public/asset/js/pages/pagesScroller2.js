// page/comment.html
sr.reveal(`.top__content`);
sr.reveal(`.left__content`, { interval: 100,origin: 'left' }); // عدة عناصر والانتظار بينهم
sr.reveal(`.right__content`, { interval: 100,origin: 'right' }); // عدة عناصر والانتظار بينهم
sr.reveal(`.bottom__content`, { interval: 100,origin: 'bottom' }); // عدة عناصر والانتظار بينهم

// page/services_order.html
sr.reveal(`.top__form `);
sr.reveal(`.left__title , .left__form`, { origin: 'left' , interval: 100 });
sr.reveal(`.right__form`, { origin: 'right' });
sr.reveal(`.bottom__form`, { origin: 'bottom' , interval: 100 });


// page/services.html
sr.reveal(`.left__card`, { origin: 'left' , interval: 150});
sr.reveal(`.right__card`, { origin: 'right' , interval: 150});
sr.reveal(`.content__card`, { origin: 'left' });
sr.reveal(`.img__card`, { origin: 'left' });


// page/terms_conditions.html
sr.reveal(`.left__content`, { origin: 'left' , interval: 100});
sr.reveal(`.bottom__content`, { origin: 'bottom' , interval: 100});