export function range(start, end, step){
    let result = [];

    if (step === undefined){
        step = start < end ? 1 : -1;
    }

    if (step > 0){
        for (let i = start; i <= end; i += step){
            result.push(i);
        }
    } else if (step < 0){
        for (let i = start; i >= end; i += step){
            result.push(i);
        }
    }

    return result;
}