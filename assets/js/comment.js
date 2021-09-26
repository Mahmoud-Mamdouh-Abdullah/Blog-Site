"use strict";

let BASE_URL = 'http://localhost/Blog-Site/api';

const likePostComment = async (id) => {
    try {
        let req = await fetch(`${BASE_URL}/likecomment.php?id=${id}`);
        console.log(req);
        if (!req.ok) throw "Request not found";
        await req;
        let oldLikesCount = +document.querySelector(`#likes_count_${id}`).innerHTML;
        document.querySelector(`#likes_count_${id}`).innerHTML = oldLikesCount + 1;
        document.querySelector(`#likes_btn_${id}`).classList.add('d-none');
        document.querySelector(`#unlikes_btn_${id}`).classList.remove('d-none');
    } catch (ex) {
        console.log(ex);
    }
}

const unlikePostComment = async (id) => {
    try {
        let req = await fetch(`${BASE_URL}/unlikecomment.php?id=${id}`);
        console.log(req);
        if (!req.ok) throw "Request not found";
        await req;
        let oldLikesCount = +document.querySelector(`#likes_count_${id}`).innerHTML;
        document.querySelector(`#likes_count_${id}`).innerHTML = oldLikesCount - 1;
        document.querySelector(`#unlikes_btn_${id}`).classList.add('d-none');
        document.querySelector(`#likes_btn_${id}`).classList.remove('d-none');
    } catch (ex) {
        console.log(ex);
    }
}
