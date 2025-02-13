// pages/contact.html
sr.reveal(`.top__contact`);
sr.reveal(`.text__contact`, { origin: 'left' });
sr.reveal(`.right__contact`, { origin: 'right' });
sr.reveal(`.bottom__contact`, { origin: 'bottom' });


// pages/file_single.html
sr.reveal(`.top__files`);
sr.reveal(`.img__files`, { origin: 'left' });
sr.reveal(`.text__files`, { origin: 'right' });
sr.reveal(`.bottom__files`, { interval: 100,origin: 'bottom' }); // عدة عناصر والانتظار بينهم


// pages/files.html
sr.reveal(`.left__file`, { interval: 100,origin: 'left' }); // عدة عناصر والانتظار بينهم
sr.reveal(`.bottom__files , .card__files , .bottom__file`, { interval: 100,origin: 'bottom' }); // عدة عناصر والانتظار بينهم


// pages/consulation.html
sr.reveal(`.top__form`);
sr.reveal(`.left__form`, { origin: 'left' });
sr.reveal(`.right__form`, { origin: 'right' });
sr.reveal(`.bottom__form`, { origin: 'bottom' });


// pages/paymet.html
sr.reveal(`.top__card , .top__form`);
sr.reveal(`.left__grid , .left__form`, { origin: 'left' });
sr.reveal(`.right__grid , .right__form`, { origin: 'right' });
sr.reveal(`.bottom__card`, { origin: 'bottom' });
sr.reveal(`.bottom__form`, { origin: 'bottom' , interval: 100 });


// pages/portfolio.html
sr.reveal(`.top__portfolio`);
sr.reveal(`.img__portfolio`, { origin: 'left' });
sr.reveal(`.right__portfolio`, { origin: 'right' });
sr.reveal(`.bottom__portfolio`, { origin: 'bottom' , interval: 200});