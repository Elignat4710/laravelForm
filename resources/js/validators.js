export function photoName(value) {
    if (!value) {
        return true;
    }
    let ex = ["jpeg", "png", "jpg"];
    if (ex.indexOf(value.name.split(".").pop()) === -1) {
        return false;
    }
    return true;
}

export function photoSize(value) {
    if (!value) {
        return true;
    } else if (value.size > 2000000) {
        return false;
    }
    return true;
}
